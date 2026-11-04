<?php
include_once('administrativo_menu_session.php');
@ini_set('session.cookie_httponly', 1);
@ini_set('session.use_only_cookies', 1);
@ini_set('session.cookie_secure', 1);
@ini_set('session.cookie_samesite', 'None');
session_start();
if (!function_exists("sc_check_mobile"))
{
    include_once("../_lib/lib/php/nm_check_mobile.php");
}
$_SESSION['scriptcase']['device_mobile'] = sc_check_mobile();
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
    $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']      = "";
    $_SESSION['scriptcase']['administrativo_menu']['glo_nm_perfil']         = "conn_mysql";
    $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_imag_temp'] = "";
    $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo']      = "";
    //check publication with the prod
    $str_path_apl_url  = $_SERVER['PHP_SELF'];
    $str_path_apl_url  = str_replace("\\", '/', $str_path_apl_url);
    $str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
    $str_path_apl_url  = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
    //check prod
    if(empty($_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //end check publication with the prod

ob_start();

class administrativo_menu_class
{
  var $Db;
  var $sc_charset;
  var $force_mobile;
  var $path_botoes;
  var $path_imag_apl;
  var $path_css;
  var $url_css;
  var $menu_orientacao;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function administrativo_menu_menu()
 {
    global $administrativo_menu_menuData, $nm_data_fixa;
     if (isset($_POST["nmgp_idioma"]))  
     { 
         $Temp_lang = explode(";" , $_POST["nmgp_idioma"]);  
         if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
          { 
             $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
         } 
         if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
         { 
             $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
         } 
     } 
   
     if (isset($_POST["nmgp_schema"]))  
     { 
         $_SESSION['scriptcase']['str_schema_all'] = $_POST["nmgp_schema"] . "/" . $_POST["nmgp_schema"];
     } 
   
           $nm_versao_sc  = "" ; 
           $_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
           $Campos_Mens_erro = "";
           $sc_site_ssl   = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? true : false;
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
      //check prod
      if(empty($_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']))
      {
              /*check prod*/$_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
      }
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
$str_path_web   = $_SERVER['PHP_SELF'];
$str_path_web   = str_replace("\\", '/', $str_path_web);
$str_path_web   = str_replace('//', '/', $str_path_web);
$str_root       = substr($str_path_sys, 0, -1 * strlen($str_path_web));
$path_link      = substr($str_path_web, 0, strrpos($str_path_web, '/'));
$path_link      = substr($path_link, 0, strrpos($path_link, '/')) . '/';
$path_btn       = $str_root . $path_link . "_lib/buttons/";
$path_imag_cab  = $path_link . "_lib/img";
$this->force_mobile = false;
$this->menu_orientacao = 'horizontal';
$this->path_botoes    = '../_lib/img';
$this->path_imag_apl  = $str_root . $path_link . "_lib/img";
$path_help      = $path_link . "_lib/webhelp/";
$path_libs      = $str_root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "administrativo_menu/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$_SESSION['scriptcase']['dir_temp'] = $str_root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_imag_temp'];
$this->url_css = "../_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$menu_mobile_hide          = 'N';
$menu_mobile_inicial_state = 'aberto';
$menu_mobile_hide_onclick  = 'N';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$menu_mobile_hide_icon_menu_position     = 'right';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'aberto';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'S';
$mobile_menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide_icon_menu_position     = 'right';

$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
 if(function_exists('set_php_timezone')) set_php_timezone('administrativo_menu');
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
                $nm_apl_dest = $path_link . SC_dir_app_name($nm_apl_dest) . "/";
            }
?><!DOCTYPE html>
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
if (!defined("SC_ERROR_HANDLER"))
{
    define("SC_ERROR_HANDLER", 1);
    include_once(dirname(__FILE__) . "/administrativo_menu_erro.php");
}
include_once(dirname(__FILE__) . "/administrativo_menu_erro.class.php"); 
$this->Erro = new administrativo_menu_erro();
$str_path = substr($_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao']);
}

/* Definição dos Caminhos */
$administrativo_menu_menuData         = array();
$administrativo_menu_menuData['path'] = array();
$administrativo_menu_menuData['url']  = array();
$administrativo_menu_menuData['data'] = "";
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $administrativo_menu_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $administrativo_menu_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $administrativo_menu_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $administrativo_menu_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$administrativo_menu_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$administrativo_menu_menuData['url']['web']   = str_replace("\\", '/', $administrativo_menu_menuData['url']['web']);
$administrativo_menu_menuData['path']['root'] = substr($administrativo_menu_menuData['path']['sys'],  0, -1 * strlen($administrativo_menu_menuData['url']['web']));
$administrativo_menu_menuData['path']['app']  = substr($administrativo_menu_menuData['path']['sys'],  0, strrpos($administrativo_menu_menuData['path']['sys'],  '/'));
$administrativo_menu_menuData['path']['link'] = substr($administrativo_menu_menuData['path']['app'],  0, strrpos($administrativo_menu_menuData['path']['app'],  '/'));
$administrativo_menu_menuData['path']['link'] = substr($administrativo_menu_menuData['path']['link'], 0, strrpos($administrativo_menu_menuData['path']['link'], '/')) . '/';
$administrativo_menu_menuData['path']['app'] .= '/';
$administrativo_menu_menuData['url']['app']   = substr($administrativo_menu_menuData['url']['web'],  0, strrpos($administrativo_menu_menuData['url']['web'],  '/'));
$administrativo_menu_menuData['url']['link']  = substr($administrativo_menu_menuData['url']['app'],  0, strrpos($administrativo_menu_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] == "S")
{
    $administrativo_menu_menuData['url']['link']  = substr($administrativo_menu_menuData['url']['link'], 0, strrpos($administrativo_menu_menuData['url']['link'], '/'));
}
$administrativo_menu_menuData['url']['link']  .= '/';
$administrativo_menu_menuData['url']['app']   .= '/';


$_SESSION['scriptcase']['administrativo_menu']['sc_apl_link'] = $administrativo_menu_menuData['url']['link'];

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
if (isset($_SESSION['scriptcase']['administrativo_menu']['session_timeout']['lang'])) {
    $this->str_lang = $_SESSION['scriptcase']['administrativo_menu']['session_timeout']['lang'];
}
elseif (!isset($_SESSION['scriptcase']['administrativo_menu']['actual_lang']) || $_SESSION['scriptcase']['administrativo_menu']['actual_lang'] != $this->str_lang) {
    $_SESSION['scriptcase']['administrativo_menu']['actual_lang'] = $this->str_lang;
    setcookie('sc_actual_lang_NRSVP115_10_AWS_APP',$this->str_lang,'0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
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
if ($_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] == "S")
{
    $path_apls     = substr($path_apls, 0, strrpos($path_apls, '/'));
}
$path_apls     .= "/";
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "rsvp02/rsvp02";
include("../_lib/lang/". $this->str_lang .".lang.php");
include("../_lib/css/" . $this->str_schema_all . "_menutab.php");
include("../_lib/css/" . $this->str_schema_all . "_menuH.php");
if(isset($pagina_schemamenu) && !empty($pagina_schemamenu) && is_file("../_lib/menuicons/". $pagina_schemamenu .".php"))
{
    include("../_lib/menuicons/". $pagina_schemamenu .".php");
}
$this->img_sep_toolbar = trim($str_toolbar_separator);
include("../_lib/lang/config_region.php");
include("../_lib/lang/lang_config_region.php");
$this->regionalDefault();
$Str_btn_menu = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
$Str_btn_css  = trim($str_button) . "/" . trim($str_button) . ".css";
$this->css_menutab_active_close_icon    = trim($css_menutab_active_close_icon);
$this->css_menutab_inactive_close_icon  = trim($css_menutab_inactive_close_icon);
$this->breadcrumbline_separator  = trim($breadcrumbline_separator);
include($path_btn . $Str_btn_menu);
if (!function_exists("nmButtonOutput"))
{
   include_once("../_lib/lib/php/nm_gp_config_btn.php");
}
asort($this->Nm_lang_conf_region);
$this->sc_Include($path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
$this->sc_Include($path_lib_php . "/nm_functions.php", "", "") ; 
$this->sc_Include($path_lib_php . "/nm_api.php", "", "") ; 
$this->nm_data = new nm_data("pt_br");
include_once("administrativo_menu_toolbar.php");

$this->tab_grupo[0] = "NRSVP115_10_AWS_APP/";
if ($_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

     $_SESSION['scriptcase']['menu_atual'] = "administrativo_menu";
     $_SESSION['scriptcase']['menu_apls']['administrativo_menu'] = array();
     if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
     {
         foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
         {
             if (isset($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao']) && $_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['administrativo_menu']['glo_nm_perfil']) && $_SESSION['scriptcase']['administrativo_menu']['glo_nm_perfil'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['administrativo_menu']['glo_nm_perfil'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['administrativo_menu']['glo_con_' . $NM_con_orig]))
             {
                 $_SESSION['scriptcase']['administrativo_menu']['glo_con_' . $NM_con_orig] = $NM_con_dest;
             }
         }
     }
$_SESSION['scriptcase']['charset'] = "UTF-8";
ini_set('default_charset', $_SESSION['scriptcase']['charset']);
$_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
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
if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
{
    $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
}
if (isset($_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir'])) {
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
    if ($_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body>\r\n";
    }
    else {
        $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menuH.css\"/>\r\n";
        $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_menuH" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
        $SS_cod_html .= "  </HEAD>\r\n";
        $SS_cod_html .= "   <body class=\"scMenuHPage\">\r\n";
        $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div>\r\n";
        $SS_cod_html .= "    <table class=\"scMenuHTable\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scMenuHHeader\"><td class=\"scMenuHHeaderFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
        $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
        $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
        $SS_cod_html .= "           target=\"_self\">\r\n";
        $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir'] . "');\">\r\n";
        $SS_cod_html .= "     </form>\r\n";
        $SS_cod_html .= "    </td></tr></table>\r\n";
        $SS_cod_html .= "    </div></td></tr></table>\r\n";
    }
    $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
    if ($_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir_tp'] == "R") {
        $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir'] . "');\r\n";
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
    unset($_SESSION['scriptcase']['administrativo_menu']['session_timeout']);
    unset($_SESSION['sc_session']);
}
if (isset($SS_cod_html))
{
    echo $SS_cod_html;
    exit;
}
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
if (is_dir($path_img_old))
{
    $Res_dir_img = @opendir($path_img_old);
    if ($Res_dir_img)
    {
        while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
        {
           $Str_arquivo = "/" . $Str_arquivo;
           if (@is_file($path_img_old . $Str_arquivo) && '.' != $Str_arquivo && '..' != $path_img_old . $Str_arquivo)
           {
               @unlink($path_img_old . $Str_arquivo);
           }
        }
    }
    @closedir($Res_dir_img);
    rmdir($path_img_old);
}
//
if (isset($_GET) && !empty($_GET))
{
    foreach ($_GET as $nmgp_var => $nmgp_val)
    {
        if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
        {
            $nmgp_var = substr($nmgp_var, 11);
            $nmgp_val = $_SESSION[$nmgp_val];
        }
        if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
        {
            $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($_POST) && !empty($_POST))
{
    foreach ($_POST as $nmgp_var => $nmgp_val)
    {
        if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
        {
            $nmgp_var = substr($nmgp_var, 11);
            $nmgp_val = $_SESSION[$nmgp_val];
        }
        if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
        {
            $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (!isset($_SERVER['HTTP_REFERER']) || (!isset($nmgp_parms) && !isset($script_case_init) && !isset($nmgp_start) ))
{
    $_SESSION['sc_session']['SC_parm_violation'] = true;
}
if (isset($script_case_init))
{
    $_SESSION['sc_session'][1]['administrativo_menu']['init'] = $script_case_init;
}
else
if (!isset($_SESSION['sc_session'][1]['administrativo_menu']['init']))
{
    $_SESSION['sc_session'][1]['administrativo_menu']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['administrativo_menu']['init'];
if (isset($nmgp_parms) && !empty($nmgp_parms)) 
{ 
    $nmgp_parms = NM_decode_input($nmgp_parms);
    $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
    $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
    $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
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
       $Tmp_par   = $cadapar[0];;
       $$Tmp_par = $cadapar[1];
       $_SESSION[$cadapar[0]] = $cadapar[1];
       $ix++;
     }
} 
if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir']))
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
$nm_url_saida = "";
if (isset($nmgp_url_saida))
{
    $nm_url_saida = $nmgp_url_saida;
    if (isset($script_case_init))
    {
        $nm_url_saida .= "?script_case_init=" . NM_encode_input($script_case_init);
    }
}
if (isset($_POST["nmgp_idioma"]) || isset($_POST["nmgp_schema"]))  
{ 
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_administrativo_menu'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_administrativo_menu'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_administrativo_menu'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
}
$this->sc_Include($path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
include_once($path_adodb . "/adodb.inc.php"); 
$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
perfil_lib($path_libs);
if (!isset($_SESSION['sc_session'][1]['SC_Check_Perfil']))
{
    if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($path_libs, $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']);
    $_SESSION['sc_session'][1]['SC_Check_Perfil'] = true;
}
$_SESSION['scriptcase']['sc_num_page'] = 1;
$_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
$_SESSION['scriptcase']['sc_cnt_sql'] = 0;
$_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1D9XsDQX7Z1N7HurqHgrKVIBsDuX7VEFGHQNwZ1X7D1rwHuFGHgveVkJ3DWF/VoBiDcJUZSX7Z1BYHuFaDMvOVIBsDWrmVoF7HQNmZkBiHABYHQNUHgveHArsDWFGDoBqHQXsZ9F7HAvOV5XGDMrYDkBsHEBmVEX7HQXOZ1BOHIveHQJwDEBODkFeH5FYVoFGHQJKDQJsZ1BYD5NUDMBYVcFCDWFYDoJsDcJUZ1F7HANOHQFGHgvsHEXeDuFYZuBqHQXsDQFUHAveVWXGHuzGVcFeDWXCDoJsDcBwH9B/Z1rYHQJwDErKZSXeDWr/DoFUDcJeH9FGHANOV5JwHuNOVIFCHEF/DoraHQJmZ1F7Z1vmD5rqDEBOHArCDWBmDoB/DcJeDQX7D1veD5F7HuvmVcBOV5F/DoFGD9XOH9FaD1rKD5XGDMBYHEJGH5F/VoXGD9NmH9X7Z1rwV5raHuNOVcBODWFYDoJsD9BiZkFUZ1NOD5BqDEBeHEBUDWF/HIJsD9XsZ9JeD1BeD5F7DMvmVcXKH5XCHMX7DcJUZSB/D1rKHQraDMveHErsDWXCHIF7DcXOZSFUHABYHQJsDMzGZSNiDWXCHMBiD9BsVIraD1rwV5X7HgBeHErCV5B7ZuJsDcXGDQFaHArYHQrqDMNOZSNiH5B7DoXGDcNmZ1X7HIveHuXGHgvsVkJ3H5X/VoFGDcXGZ9F7HANOV5FaDMvsVcFeDurGDoXGHQXGZ1FGZ1NOHuFUHgBOHEJqHEB7DoF7D9XsDQJsDSBYV5FGHgNKDkBsDurGVEBiDcFYZSBOHArYHQF7DMveHEJqDuXKVoFGHQBiZSFUD1BeV5FaDMBODkBsDuB7DoXGDcNmZ1BOHArYHuB/HgrKZSJ3DWrGVoFGHQXODuFaD1BOV5BODMrYZSNiH5B7VoBqD9BsZ1F7DSrYD5rqDMrYZSJ3HEB7ZuJsHQNwH9FUHAN7HuBqHgrwVcBUDuFGDoXGHQXOVIJsHIveHQBiHgBeZSJqH5X/VoFGHQXODQBqDSzGVWXGHgvOVcFeV5BmDoXGDcFYZ1X7DSrYHQBqHgBOHEJqH5BmDoF7D9XsDQJsDSBYV5FGHgNKDkFCH5FqVoBqDcNwH9FaHArKD5NUDEvsHEFiDuJeDoFUHQJKZ9F7DSvCV5JwDMBOVcrsDWJeVoraDcJUH9FaHAN7D5NUDEBOHAFKDWF/HINUD9JKDQX7HIBeD5JwHuzGZSJ3V5X7HIX7DcJUZ1FaD1rKHuBODMBYHEXeHEFaVoB/HQXGZSFGHAvCV5XGDMvOVcFiV5X7VEF7D9BiH9FaHIBeD5XGDEBOZSXeV5FaZuFaHQXGZSFGD1BeV5FGHuzGVIBOHEFYVorqD9BiZ1F7D1rwD5NUDErKZSXeH5FGDoB/DcJUZSX7HIBeD5BqHgvsZSJ3H5FqVoFGDcBqH9BOZ1BeV5XGDEBOZSJGH5FYZuFaDcXOZSBiHANOHuJeDMvmVIBsDur/VoBiHQJmZ1BOHAN7HuFaHgvsDkXKH5BmZuBqHQBiDuBqHAvmVWJwDMrYVIBsDWXCDoJsDcBwH9B/Z1rYHQJwHgveDkXKDWBmDoJeHQXOZ9XGHANKVWBqDMvOV9BUDuX7HMBiD9BsVIraD1rwV5X7HgBeHErCHEB7DoXGHQJeDQBqD1BOV5JeHgrKZSJqH5XKVorqD9XOZ1F7D1rwHQJsHgBOVkJ3H5F/HIJsD9XsZ9JeD1BeD5F7DMvmVcFeDWJeDoraD9BsZ1rqHANOV5JeDEvsHEBUDWFqDoJeDcJUDQB/HAN7D5BqHgvsVcBODuX7DoraD9BsZSFaD1NaD5raHgvsHEBUH5F/VoFaDcJeDuBOZ1N7HuFaHuNOZSrCH5FqDoXGHQJmZ1BiDSvOV5FUHgveHEBOV5JeZura";
$nm_falta_var    = ""; 
$nm_falta_var_db = ""; 
if (isset($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao']))
{
    db_conect_devel($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'], 'NRSVP115_10_AWS_APP', 2); 
}
if (isset($_SESSION['scriptcase']['administrativo_menu']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['administrativo_menu']['glo_nm_perfil']))
{
   $_SESSION['scriptcase']['glo_perfil'] = $_SESSION['scriptcase']['administrativo_menu']['glo_nm_perfil'];
}
if (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
{
    $_SESSION['scriptcase']['glo_senha_protect'] = "";
    carrega_perfil($_SESSION['scriptcase']['glo_perfil'], $path_libs, "S");
    if (empty($_SESSION['scriptcase']['glo_senha_protect']))
    {
        $nm_falta_var .= "Perfil=" . $_SESSION['scriptcase']['glo_perfil'] . "; ";
    }
}
if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
{
    $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
    if (strlen($SC_temp) == 2)
    {
       $_SESSION['scriptcase']['administrativo_menu']['SC_sep_date']  = substr($SC_temp, 0, 1); 
       $_SESSION['scriptcase']['administrativo_menu']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
   }
   else
    {
       $_SESSION['scriptcase']['administrativo_menu']['SC_sep_date']  = $SC_temp; 
       $_SESSION['scriptcase']['administrativo_menu']['SC_sep_date1'] = $SC_temp; 
   }
}
if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
{
    $nm_falta_var_db .= "glo_tpbanco; ";
}
else
{
    $nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
}
if (!isset($_SESSION['scriptcase']['glo_servidor']))
{
    $nm_falta_var_db .= "glo_servidor; ";
}
else
{
    $nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
}
if (!isset($_SESSION['scriptcase']['glo_banco']))
{
    $nm_falta_var_db .= "glo_banco; ";
}
else
{
    $nm_banco = $_SESSION['scriptcase']['glo_banco']; 
}
if (!isset($_SESSION['scriptcase']['glo_usuario']))
{
    $nm_falta_var_db .= "glo_usuario; ";
}
else
{
    $nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
}
if (!isset($_SESSION['scriptcase']['glo_senha']))
{
    $nm_falta_var_db .= "glo_senha; ";
}
else
{
    $nm_senha = $_SESSION['scriptcase']['glo_senha']; 
}
$nm_con_db2 = array();
$nm_database_encoding = "";
if (isset($_SESSION['scriptcase']['glo_database_encoding']))
{
    $nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
}
$nm_arr_db_extra_args = array();
if (isset($_SESSION['scriptcase']['glo_use_ssl']))
{
    $nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
{
    $nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
{
    $nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
{
    $nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
{
    $nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
{
    $nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
}
if (isset($_SESSION['scriptcase']['postgres_sslmode']))
{
    $nm_arr_db_extra_args['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
}
if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
{
    $nm_arr_db_extra_args['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
}
if (isset($_SESSION['scriptcase']['postgres_sslkey']))
{
    $nm_arr_db_extra_args['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
}
if (isset($_SESSION['scriptcase']['postgres_sslcert']))
{
    $nm_arr_db_extra_args['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
}
if (isset($_SESSION['scriptcase']['mssql_encrypt']))
{
    $nm_arr_db_extra_args['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
}
if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
{
    $nm_arr_db_extra_args['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
}
if (isset($_SESSION['scriptcase']['mssql_truststore']))
{
    $nm_arr_db_extra_args['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
}
if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
{
    $nm_arr_db_extra_args['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
}
if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
{
    $nm_arr_db_extra_args['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_autocommit']))
{
    $nm_con_db2['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']))
{
    $nm_con_db2['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']))
{
    $nm_con_db2['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']))
{
    $nm_con_db2['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_query_optimize']))
{
    $nm_con_db2['db2_i5_query_optimize'] = $_SESSION['scriptcase']['glo_db2_i5_query_optimize']; 
}
if (isset($_SESSION['scriptcase']['oracle_type']))
{
    $nm_arr_db_extra_args['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
}
if (isset($_SESSION['scriptcase']['ibase_charset']))
{
    $nm_arr_db_extra_args['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
}
if (isset($_SESSION['scriptcase']['ibase_rolename']))
{
    $nm_arr_db_extra_args['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
}
if (isset($_SESSION['scriptcase']['ibase_dialect']))
{
    $nm_arr_db_extra_args['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
}
if (isset($_SESSION['scriptcase']['security']))
{
    $nm_arr_db_extra_args['security'] = $_SESSION['scriptcase']['security']; 
}
if (isset($_SESSION['scriptcase']['sslservercertificate']))
{
    $nm_arr_db_extra_args['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
}
if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
{
    $nm_arr_db_extra_args['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
}
if (isset($_SESSION['scriptcase']['sslclientkeystash']))
{
    $nm_arr_db_extra_args['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
}
if (isset($_SESSION['scriptcase']['authentication']))
{
    $nm_arr_db_extra_args['authentication'] = $_SESSION['scriptcase']['authentication']; 
}
if (isset($_SESSION['scriptcase']['sslclientlabel']))
{
    $nm_arr_db_extra_args['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
}
if (isset($_SESSION['scriptcase']['use_ssh']))
{
    $nm_arr_db_extra_args['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
}
if (isset($_SESSION['scriptcase']['ssh_server']))
{
    $nm_arr_db_extra_args['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
}
if (isset($_SESSION['scriptcase']['ssh_user']))
{
    $nm_arr_db_extra_args['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
}
if (isset($_SESSION['scriptcase']['ssh_port']))
{
    $nm_arr_db_extra_args['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
}
if (isset($_SESSION['scriptcase']['ssh_privatecert']))
{
    $nm_arr_db_extra_args['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
}
if (isset($_SESSION['scriptcase']['ssh_localserver']))
{
    $nm_arr_db_extra_args['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
}
if (isset($_SESSION['scriptcase']['ssh_localport']))
{
    $nm_arr_db_extra_args['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
}
if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
{
    $nm_arr_db_extra_args['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
}
$nm_con_persistente = "";
$nm_con_use_schema  = "";
if (isset($_SESSION['scriptcase']['glo_use_persistent']))
{
    $nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
}
if (isset($_SESSION['scriptcase']['glo_use_schema']))
{
    $nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
}
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
$str_message = str_replace('{var_str_message_conn}','', $str_message);
$str_message = str_replace('{v_str_btn_inside}', '', $str_message);
if (!empty($nm_falta_var) || !empty($nm_falta_var_db))
{
    if (empty($nm_falta_var_db))
    {
         $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_glob'], $str_message);
    }
    else
    {
         $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_data'], $str_message);
    }
    echo $str_message;
    if (isset($_SESSION['scriptcase']['nm_ret_exec']) && '' != $_SESSION['scriptcase']['nm_ret_exec'])
    { 
        if (isset($_SESSION['sc_session'][1]['administrativo_menu']['sc_outra_jan']) && $_SESSION['sc_session'][1]['administrativo_menu']['sc_outra_jan'])
        {
            echo "<a href='javascript:window.close()'><img border='0' src='" . $path_imag_cab . "/scriptcase__NM__exit.gif' title='" . $this->Nm_lang['lang_btns_menu_rtrn_hint'] . "' align=absmiddle></a> \n" ; 
        } 
        else 
        { 
            echo "<a href='" . $_SESSION['scriptcase']['nm_ret_exec'] . "><img border='0' src='" . $path_imag_cab . "/scriptcase__NM__exit.gif' title='" . $this->Nm_lang['lang_btns_menu_rtrn_hint'] . "' align=absmiddle></a> \n" ; 
        } 
    } 
    echo $str_message_end;
    exit ;
} 
if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
{
    $nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
}
if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
{
    $nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
}
if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
{
    $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
}
$sc_tem_trans_banco = false;
$this->nm_bases_access    = array("access", "ado_access", "ace_access");
$this->nm_bases_db2       = array("db2", "db2_odbc", "odbc_db2", "odbc_db2v6", "pdo_db2_odbc", "pdo_ibm");
$this->nm_bases_ibase     = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
$this->nm_bases_informix  = array("informix", "informix72", "pdo_informix");
$this->nm_bases_mssql     = array("mssql", "ado_mssql", "adooledb_mssql", "odbc_mssql", "mssqlnative", "pdo_sqlsrv", "pdo_dblib", "azure_mssql", "azure_ado_mssql", "azure_adooledb_mssql", "azure_odbc_mssql", "azure_mssqlnative", "azure_pdo_sqlsrv", "azure_pdo_dblib", "googlecloud_mssql", "googlecloud_ado_mssql", "googlecloud_adooledb_mssql", "googlecloud_odbc_mssql", "googlecloud_mssqlnative", "googlecloud_pdo_sqlsrv", "googlecloud_pdo_dblib", "amazonrds_mssql", "amazonrds_ado_mssql", "amazonrds_adooledb_mssql", "amazonrds_odbc_mssql", "amazonrds_mssqlnative", "amazonrds_pdo_sqlsrv", "amazonrds_pdo_dblib");
$this->nm_bases_mysql     = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "pdo_mariadb", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "azure_pdo_mariadb", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "googlecloud_pdo_mariadb", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql", "amazonrds_pdo_mariadb");
$this->nm_bases_postgres  = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
$this->nm_bases_oracle    = array("oci8", "oci805", "oci8po", "odbc_oracle", "oracle", "pdo_oracle", "oraclecloud_oci8", "oraclecloud_oci805", "oraclecloud_oci8po", "oraclecloud_odbc_oracle", "oraclecloud_oracle", "oraclecloud_pdo_oracle", "amazonrds_oci8", "amazonrds_oci805", "amazonrds_oci8po", "amazonrds_odbc_oracle", "amazonrds_oracle", "amazonrds_pdo_oracle");
$this->nm_bases_sqlite    = array("sqlite", "sqlite3", "pdosqlite");
$this->nm_bases_sybase    = array("sybase", "pdo_sybase_odbc", "pdo_sybase_dblib");
$this->nm_bases_vfp       = array("vfp");
$this->nm_bases_odbc      = array("odbc");
$this->nm_bases_progress  = array("pdo_progress_odbc", "progress");
 $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao']))
{ 
   $this->Db = db_conect_devel($_SESSION['scriptcase']['administrativo_menu']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'], 'NRSVP115_10_AWS_APP'); 
} 
else 
{ 
   $this->Db = db_conect($nm_tpbanco, $nm_servidor, $nm_usuario, $nm_senha, $nm_banco, $glo_senha_protect, "S", $nm_con_persistente, $nm_con_db2, $nm_database_encoding, $nm_arr_db_extra_args); 
} 
$this->nm_tpbanco = $nm_tpbanco; 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_ibase) && function_exists('ibase_timefmt'))
{
    ibase_timefmt('%Y-%m-%d %H:%M:%S');
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_sybase))
{
   $this->Db->fetchMode = ADODB_FETCH_BOTH;
   $this->Db->Execute("set dateformat ymd");
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_db2))
{
   $this->Db->fetchMode = ADODB_FETCH_NUM;
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_mssql))
{
   $this->Db->Execute("set dateformat ymd");
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_oracle))
{
   $this->Db->Execute("alter session set nls_date_format         = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_timestamp_format    = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_timestamp_tz_format = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_time_format         = 'hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_time_tz_format      = 'hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_numeric_characters  = '.,'");
   $_SESSION['sc_session'][$this->Ini->sc_page]['administrativo_menu']['decimal_db'] = ".";
} 
//
      $_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
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
  $_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
date_default_timezone_set('America/Sao_Paulo');

$this->inactive();


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
	 unset($_SESSION['vg_usuario_id']);
 unset($this->sc_temp_vg_usuario_id);
 unset($_SESSION['vg_evento_id']);
 unset($this->sc_temp_vg_evento_id);
 unset($_SESSION['vg_cpfseg']);
 unset($this->sc_temp_vg_cpfseg);
;
	
 if (!isset($Campos_Mens_erro)){$Campos_Mens_erro = "";}
 if (!empty($Campos_Mens_erro)){$Campos_Mens_erro .= "<br>";}$Campos_Mens_erro .= "Acesso Negado!";
;	
	if (isset($Campos_Mens_erro) && !empty($Campos_Mens_erro))
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
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B>ERRO</B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="<?php echo $path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";?>"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo NM_encode_input('1') ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
/* Dados do menu em sessao */
$_SESSION['nm_menu'] = array('prod' => $str_root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'] . '/third/COOLjsMenu/',
                              'url' => $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod'] . '/third/COOLjsMenu/');

if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'administrativo_menu'))
{
    $_SESSION['sc_session'][1]['administrativo_menu']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_administrativo_menu'] = "javascript:window.close()";
}
/* Variáveis de Configuração do Menu */
$administrativo_menu_menuData['iframe'] = TRUE;

if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
if(is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_eventos_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_eventos_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
      if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp']))
      {
        $_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp'] = "on";
      }
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp'] = "on";
} 
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_usuarios_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_usuarios_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_rsvpses_log_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_rsvpses_log_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_rsvpses_log_n_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_rsvpses_log_n_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log_n']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log_n'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log_n'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_usuarios_rsvp_2fa_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_usuarios_rsvp_2fa_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp_2fa']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp_2fa'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp_2fa'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_rsvp_log_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_rsvp_log_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_rsvp_log_api_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_rsvp_log_api_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log_api']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log_api'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log_api'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_bkp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_bkp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_bkp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_bkp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_bkp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_acomodacoes_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_acomodacoes_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_acomodacoes']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_acomodacoes'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_acomodacoes'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_categ_acomod_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_categ_acomod_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_acomod']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_acomod'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_acomod'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_aeroportos_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_aeroportos_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_aeroportos']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_aeroportos'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_aeroportos'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_aeroporto_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_aeroporto_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_aeroporto']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_aeroporto'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_aeroporto'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_cia_aereas_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_cia_aereas_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cia_aereas']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cia_aereas'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cia_aereas'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_cidades_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_cidades_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cidades']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cidades'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cidades'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_fornecedores_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_fornecedores_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_fornecedores']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_fornecedores'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_fornecedores'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_hoteis_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_hoteis_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_categ_hoteis_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_categ_hoteis_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_hoteis']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_hoteis'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_hoteis'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_hoteis_class_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_hoteis_class_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis_class']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis_class'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis_class'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_rede_hoteis_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_rede_hoteis_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_rede_hoteis']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_rede_hoteis'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_rede_hoteis'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_locacoes_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_locacoes_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_locacoes']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_locacoes'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_locacoes'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_paises_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_paises_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_paises']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_paises'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_paises'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_ufs_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_ufs_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_ufs']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_ufs'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_ufs'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_empresas_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_empresas_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_empresas_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_empresas_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_empresas_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_opcionais_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_opcionais_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_opcionais']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_opcionais'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_opcionais'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_pagamentos_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_pagamentos_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pagamentos_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_pagamentos_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_pagamentos_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_pessoas_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_pessoas_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_programacao_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_programacao_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_programacao']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_programacao'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_programacao'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_publico_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_publico_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_publico_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_publico_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_publico_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_regionais_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_regionais_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_regionais']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_regionais'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_regionais'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_tbl_tours_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_tbl_tours_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_tours']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_tours'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_tours'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_modelo_mailling_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_modelo_mailling_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_modelo_mailling_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_modelo_mailling_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_modelo_mailling_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_acompanhantes_rsvp_2_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_acompanhantes_rsvp_2_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_acompanhantes_rsvp_2']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_acompanhantes_rsvp_2'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_acompanhantes_rsvp_2'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_participantes_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_participantes_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_participantes_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_participantes_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_participantes_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_bloq_ac_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_bloq_ac_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_bloq_ac']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_bloq_ac'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_bloq_ac'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_hospedagem_rsvp_ar1_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_hospedagem_rsvp_ar1_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar1']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar1'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar1'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_hospedagem_rsvp_ar_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_hospedagem_rsvp_ar_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_pub_ac_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_pub_ac_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_pub_ac']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_pub_ac'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_pub_ac'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_participantes_rsvp_ar_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_participantes_rsvp_ar_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_participantes_rsvp_ar']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_participantes_rsvp_ar'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_participantes_rsvp_ar'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_part_ac_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_part_ac_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_part_ac']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_part_ac'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_part_ac'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_voucher_ac_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_voucher_ac_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_voucher_ac']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_voucher_ac'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_voucher_ac'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_mail_ac_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_mail_ac_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_mail_ac']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_mail_ac'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_mail_ac'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_pessoas_rsvp_3_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_pessoas_rsvp_3_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_3']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_3'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_3'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_spessoas_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_spessoas_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_spessoas']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_spessoas'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_spessoas'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_log_bkp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_log_bkp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_log_bkp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_log_bkp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_log_bkp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_pessoas_rsvp_1_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_pessoas_rsvp_1_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_1']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_1'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_1'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_eventos_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_eventos_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_ciasaer_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_ciasaer_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_ciasaer_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_ciasaer_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_ciasaer_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_empresas_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_empresas_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_empresas_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_empresas_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_empresas_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_hoteis_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_hoteis_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_hoteis_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_hoteis_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_hoteis_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_publicos_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_publicos_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_publicos_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_publicos_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_publicos_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_regionais_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_regionais_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_regionais_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_regionais_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_regionais_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_tours_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_tours_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_tours_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_tours_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_tours_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_empresas_usr_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_empresas_usr_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_empresas_usr_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_empresas_usr_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_empresas_usr_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_usuarios_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_usuarios_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_usuarios_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_usuarios_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_usuarios_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_bloqueio_aereo_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_bloqueio_aereo_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_aereo_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_aereo_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_aereo_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_bloqueio_hoteis_rsvp_1_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_bloqueio_hoteis_rsvp_1_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_hoteis_rsvp_1']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_hoteis_rsvp_1'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_hoteis_rsvp_1'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_eventos_opcionais_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_eventos_opcionais_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_opcionais_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_opcionais_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_opcionais_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/form_eventos_programa_sf_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/form_eventos_programa_sf_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_programa_sf']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_programa_sf'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['form_eventos_programa_sf'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_confirmacao_viagem_rsvp_1_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_confirmacao_viagem_rsvp_1_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_confirmacao_viagem_rsvp_1']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_confirmacao_viagem_rsvp_1'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_confirmacao_viagem_rsvp_1'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_mailling_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_mailling_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_mailling_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_mailling_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_mailling_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/grid_inconsistmailling_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/grid_inconsistmailling_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_inconsistmailling']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['grid_inconsistmailling'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['grid_inconsistmailling'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/chart_aereos_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/chart_aereos_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/chart_aereos_rsvp_va_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/chart_aereos_rsvp_va_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp_va']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp_va'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp_va'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/chart_hospedagem_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/chart_hospedagem_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/chart_hospedagem_rsvp_vh_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/chart_hospedagem_rsvp_vh_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp_vh']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp_vh'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp_vh'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/chart_participantes_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/chart_participantes_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_participantes_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['chart_participantes_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['chart_participantes_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/chart_presencas_rsvp_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/chart_presencas_rsvp_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_presencas_rsvp']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['chart_presencas_rsvp'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['chart_presencas_rsvp'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/control_rel_01_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/control_rel_01_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['control_rel_01'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . '_lib/_app_data/blank_limpaRel_ini.php'))
{
    require($path_apls . $this->tab_grupo[0] .'_lib/_app_data/blank_limpaRel_ini.php');
    if ((!isset($arr_data['status']) || trim($arr_data['status']) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['blank_limpaRel']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['blank_limpaRel'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['blank_limpaRel'] = "on";
    } 
}
/* Itens do Menu */
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
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
  $_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
date_default_timezone_set('America/Sao_Paulo');

$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'cpf');

if ($usunivel <> 'ERRO') {
	$cpf = $this->usulog2($usunivel);		
	if ($cpf == 'ERRO') {
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
		
 if (!isset($Campos_Mens_erro)){$Campos_Mens_erro = "";}
 if (!empty($Campos_Mens_erro)){$Campos_Mens_erro .= "<br>";}$Campos_Mens_erro .= "Acesso Negado! adm_menu_1adm";
;	
		if (isset($Campos_Mens_erro) && !empty($Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
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
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B>ERRO</B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="<?php echo $path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";?>"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo NM_encode_input('1') ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}	
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
	
 if (!isset($Campos_Mens_erro)){$Campos_Mens_erro = "";}
 if (!empty($Campos_Mens_erro)){$Campos_Mens_erro .= "<br>";}$Campos_Mens_erro .= "Acesso Negado! adm_menu_2adm";
;	
	if (isset($Campos_Mens_erro) && !empty($Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
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
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B>ERRO</B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="<?php echo $path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";?>"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo NM_encode_input('1') ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
if ($this->Db)
{
    $this->Db->Close(); 
}

$sOutputBuffer = ob_get_contents();
ob_end_clean();

 $nm_var_lab[0] = "Cad. Usuários";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[0]))
{
    $nm_var_lab[0] = sc_convert_encoding($nm_var_lab[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[1] = "Usuário(s)";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[1]))
{
    $nm_var_lab[1] = sc_convert_encoding($nm_var_lab[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[2] = "Logados";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[2]))
{
    $nm_var_lab[2] = sc_convert_encoding($nm_var_lab[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[3] = "Histórico LOG";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[3]))
{
    $nm_var_lab[3] = sc_convert_encoding($nm_var_lab[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[4] = "Usuários  2FA";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[4]))
{
    $nm_var_lab[4] = sc_convert_encoding($nm_var_lab[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[5] = "LOG Geral RSVP";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[5]))
{
    $nm_var_lab[5] = sc_convert_encoding($nm_var_lab[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[6] = "LOG API";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[6]))
{
    $nm_var_lab[6] = sc_convert_encoding($nm_var_lab[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[7] = "Cópias de Segurança";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[7]))
{
    $nm_var_lab[7] = sc_convert_encoding($nm_var_lab[7], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[8] = "Auxiliares";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[8]))
{
    $nm_var_lab[8] = sc_convert_encoding($nm_var_lab[8], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[9] = "Acomodações ";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[9]))
{
    $nm_var_lab[9] = sc_convert_encoding($nm_var_lab[9], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[10] = "Acomodações Categorias";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[10]))
{
    $nm_var_lab[10] = sc_convert_encoding($nm_var_lab[10], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[11] = "Aeroportos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[11]))
{
    $nm_var_lab[11] = sc_convert_encoding($nm_var_lab[11], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[12] = "Aeroportos (RSVP antigo)";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[12]))
{
    $nm_var_lab[12] = sc_convert_encoding($nm_var_lab[12], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[13] = "Cias Aéreas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[13]))
{
    $nm_var_lab[13] = sc_convert_encoding($nm_var_lab[13], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[14] = "Cidades";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[14]))
{
    $nm_var_lab[14] = sc_convert_encoding($nm_var_lab[14], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[15] = "Fornecedores Diversos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[15]))
{
    $nm_var_lab[15] = sc_convert_encoding($nm_var_lab[15], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[16] = "Hotéis";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[16]))
{
    $nm_var_lab[16] = sc_convert_encoding($nm_var_lab[16], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[17] = "Hotéis Categorias";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[17]))
{
    $nm_var_lab[17] = sc_convert_encoding($nm_var_lab[17], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[18] = "Hotéis Classes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[18]))
{
    $nm_var_lab[18] = sc_convert_encoding($nm_var_lab[18], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[19] = "Hotéis Redes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[19]))
{
    $nm_var_lab[19] = sc_convert_encoding($nm_var_lab[19], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[20] = "Locações Tipos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[20]))
{
    $nm_var_lab[20] = sc_convert_encoding($nm_var_lab[20], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[21] = "Países";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[21]))
{
    $nm_var_lab[21] = sc_convert_encoding($nm_var_lab[21], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[22] = "UF's";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[22]))
{
    $nm_var_lab[22] = sc_convert_encoding($nm_var_lab[22], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[23] = "Auxiliares RSVP";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[23]))
{
    $nm_var_lab[23] = sc_convert_encoding($nm_var_lab[23], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[24] = "Empresas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[24]))
{
    $nm_var_lab[24] = sc_convert_encoding($nm_var_lab[24], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[25] = "Opcionais";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[25]))
{
    $nm_var_lab[25] = sc_convert_encoding($nm_var_lab[25], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[26] = "Pagamentos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[26]))
{
    $nm_var_lab[26] = sc_convert_encoding($nm_var_lab[26], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[27] = "Pessoas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[27]))
{
    $nm_var_lab[27] = sc_convert_encoding($nm_var_lab[27], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[28] = "Programações";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[28]))
{
    $nm_var_lab[28] = sc_convert_encoding($nm_var_lab[28], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[29] = "Públicos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[29]))
{
    $nm_var_lab[29] = sc_convert_encoding($nm_var_lab[29], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[30] = "Regionais";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[30]))
{
    $nm_var_lab[30] = sc_convert_encoding($nm_var_lab[30], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[31] = "Tours";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[31]))
{
    $nm_var_lab[31] = sc_convert_encoding($nm_var_lab[31], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[32] = "Modelo Mailling";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[32]))
{
    $nm_var_lab[32] = sc_convert_encoding($nm_var_lab[32], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[33] = "Participações";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[33]))
{
    $nm_var_lab[33] = sc_convert_encoding($nm_var_lab[33], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[34] = "Acompanhantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[34]))
{
    $nm_var_lab[34] = sc_convert_encoding($nm_var_lab[34], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[35] = "Participantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[35]))
{
    $nm_var_lab[35] = sc_convert_encoding($nm_var_lab[35], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[36] = "Ações Rápidas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[36]))
{
    $nm_var_lab[36] = sc_convert_encoding($nm_var_lab[36], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[37] = "Modificar Bloqueio Hoteis";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[37]))
{
    $nm_var_lab[37] = sc_convert_encoding($nm_var_lab[37], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[38] = "Substituição Completa Bloqueios";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[38]))
{
    $nm_var_lab[38] = sc_convert_encoding($nm_var_lab[38], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[39] = "Substituições Parciais Hospedagem";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[39]))
{
    $nm_var_lab[39] = sc_convert_encoding($nm_var_lab[39], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[40] = "Substituições Parciais Bloqueios Hosp.";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[40]))
{
    $nm_var_lab[40] = sc_convert_encoding($nm_var_lab[40], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[41] = "Modificar Públicos / Regionais";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[41]))
{
    $nm_var_lab[41] = sc_convert_encoding($nm_var_lab[41], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[42] = "Substituição Completas Públicos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[42]))
{
    $nm_var_lab[42] = sc_convert_encoding($nm_var_lab[42], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[43] = "Substituições Parciais Pub./Reg.";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[43]))
{
    $nm_var_lab[43] = sc_convert_encoding($nm_var_lab[43], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[44] = "Troca de informações entre Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[44]))
{
    $nm_var_lab[44] = sc_convert_encoding($nm_var_lab[44], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[45] = "Excluir Controle de Vouchers enviados";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[45]))
{
    $nm_var_lab[45] = sc_convert_encoding($nm_var_lab[45], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[46] = "Reorganizar tabelas de Maillling";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[46]))
{
    $nm_var_lab[46] = sc_convert_encoding($nm_var_lab[46], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[47] = "Cadastro de Pessoas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[47]))
{
    $nm_var_lab[47] = sc_convert_encoding($nm_var_lab[47], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[48] = "Substituição de Chave em Pessoas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[48]))
{
    $nm_var_lab[48] = sc_convert_encoding($nm_var_lab[48], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[49] = "Limpar Arquivo de LOG";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[49]))
{
    $nm_var_lab[49] = sc_convert_encoding($nm_var_lab[49], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[50] = "Correções em Chaves Primárias";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[50]))
{
    $nm_var_lab[50] = sc_convert_encoding($nm_var_lab[50], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[51] = "Administrativo";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[51]))
{
    $nm_var_lab[51] = sc_convert_encoding($nm_var_lab[51], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[52] = "Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[52]))
{
    $nm_var_lab[52] = sc_convert_encoding($nm_var_lab[52], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[53] = "Cias Aéreas/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[53]))
{
    $nm_var_lab[53] = sc_convert_encoding($nm_var_lab[53], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[54] = "Empresas/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[54]))
{
    $nm_var_lab[54] = sc_convert_encoding($nm_var_lab[54], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[55] = "Hotéis/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[55]))
{
    $nm_var_lab[55] = sc_convert_encoding($nm_var_lab[55], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[56] = "Públicos/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[56]))
{
    $nm_var_lab[56] = sc_convert_encoding($nm_var_lab[56], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[57] = "Regionais/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[57]))
{
    $nm_var_lab[57] = sc_convert_encoding($nm_var_lab[57], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[58] = "Tours/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[58]))
{
    $nm_var_lab[58] = sc_convert_encoding($nm_var_lab[58], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[59] = "Usuários/Empresas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[59]))
{
    $nm_var_lab[59] = sc_convert_encoding($nm_var_lab[59], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[60] = "Usuários/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[60]))
{
    $nm_var_lab[60] = sc_convert_encoding($nm_var_lab[60], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[61] = "Bloqueios Aéreos/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[61]))
{
    $nm_var_lab[61] = sc_convert_encoding($nm_var_lab[61], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[62] = "Bloqueio Hotéis/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[62]))
{
    $nm_var_lab[62] = sc_convert_encoding($nm_var_lab[62], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[63] = "Opcionais/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[63]))
{
    $nm_var_lab[63] = sc_convert_encoding($nm_var_lab[63], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[64] = "Programações/Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[64]))
{
    $nm_var_lab[64] = sc_convert_encoding($nm_var_lab[64], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[65] = "Subir Mailing";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[65]))
{
    $nm_var_lab[65] = sc_convert_encoding($nm_var_lab[65], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[66] = "Consulta envio Conf. Viagem";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[66]))
{
    $nm_var_lab[66] = sc_convert_encoding($nm_var_lab[66], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[67] = "Exclui participantes do Evento";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[67]))
{
    $nm_var_lab[67] = sc_convert_encoding($nm_var_lab[67], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[68] = "Exclui um  Evento";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[68]))
{
    $nm_var_lab[68] = sc_convert_encoding($nm_var_lab[68], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[69] = "Relatórios";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[69]))
{
    $nm_var_lab[69] = sc_convert_encoding($nm_var_lab[69], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[70] = "Substituições";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[70]))
{
    $nm_var_lab[70] = sc_convert_encoding($nm_var_lab[70], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[71] = "RSVP";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[71]))
{
    $nm_var_lab[71] = sc_convert_encoding($nm_var_lab[71], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[72] = "Aéreo RSVP";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[72]))
{
    $nm_var_lab[72] = sc_convert_encoding($nm_var_lab[72], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[73] = "Rooming List";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[73]))
{
    $nm_var_lab[73] = sc_convert_encoding($nm_var_lab[73], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[74] = "Romming List ( - ) ";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[74]))
{
    $nm_var_lab[74] = sc_convert_encoding($nm_var_lab[74], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[75] = "Transfer";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[75]))
{
    $nm_var_lab[75] = sc_convert_encoding($nm_var_lab[75], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[76] = "Transfer IN Aéreo ";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[76]))
{
    $nm_var_lab[76] = sc_convert_encoding($nm_var_lab[76], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[77] = "Transfer OUT Aéreo ";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[77]))
{
    $nm_var_lab[77] = sc_convert_encoding($nm_var_lab[77], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[78] = "Transfer IN/OUT  Local";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[78]))
{
    $nm_var_lab[78] = sc_convert_encoding($nm_var_lab[78], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[79] = "Transfer Próprio";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[79]))
{
    $nm_var_lab[79] = sc_convert_encoding($nm_var_lab[79], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[80] = "Geral";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[80]))
{
    $nm_var_lab[80] = sc_convert_encoding($nm_var_lab[80], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[81] = "Mailing";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[81]))
{
    $nm_var_lab[81] = sc_convert_encoding($nm_var_lab[81], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[82] = "Inconsistência Mailing";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[82]))
{
    $nm_var_lab[82] = sc_convert_encoding($nm_var_lab[82], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[83] = "Solicitações Especiais";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[83]))
{
    $nm_var_lab[83] = sc_convert_encoding($nm_var_lab[83], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[84] = "Análises";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[84]))
{
    $nm_var_lab[84] = sc_convert_encoding($nm_var_lab[84], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[85] = "Movimento por Evento / Cia. Aérea";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[85]))
{
    $nm_var_lab[85] = sc_convert_encoding($nm_var_lab[85], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[86] = "Movimento por Cia. Aérea / Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[86]))
{
    $nm_var_lab[86] = sc_convert_encoding($nm_var_lab[86], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[87] = "Movimento de Eventos / Hospedagens.";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[87]))
{
    $nm_var_lab[87] = sc_convert_encoding($nm_var_lab[87], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[88] = "Movimento de Hospedagens / Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[88]))
{
    $nm_var_lab[88] = sc_convert_encoding($nm_var_lab[88], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[89] = "Qtd. de Participantes por Evento";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[89]))
{
    $nm_var_lab[89] = sc_convert_encoding($nm_var_lab[89], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[90] = "Status de Presenças por Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[90]))
{
    $nm_var_lab[90] = sc_convert_encoding($nm_var_lab[90], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[91] = "APP - API";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[91]))
{
    $nm_var_lab[91] = sc_convert_encoding($nm_var_lab[91], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[92] = "Enviar Convites";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[92]))
{
    $nm_var_lab[92] = sc_convert_encoding($nm_var_lab[92], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[93] = "Participantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[93]))
{
    $nm_var_lab[93] = sc_convert_encoding($nm_var_lab[93], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[94] = "Acompanhantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[94]))
{
    $nm_var_lab[94] = sc_convert_encoding($nm_var_lab[94], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[95] = "Receber Respostas Convites";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[95]))
{
    $nm_var_lab[95] = sc_convert_encoding($nm_var_lab[95], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[96] = "Participantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[96]))
{
    $nm_var_lab[96] = sc_convert_encoding($nm_var_lab[96], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[97] = "Acompanhantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[97]))
{
    $nm_var_lab[97] = sc_convert_encoding($nm_var_lab[97], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[98] = "Excluir Convidado por ID - API";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[98]))
{
    $nm_var_lab[98] = sc_convert_encoding($nm_var_lab[98], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[99] = "Tutoriais";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[99]))
{
    $nm_var_lab[99] = sc_convert_encoding($nm_var_lab[99], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[100] = "Vídeos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[100]))
{
    $nm_var_lab[100] = sc_convert_encoding($nm_var_lab[100], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[101] = "01- Introdução";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[101]))
{
    $nm_var_lab[101] = sc_convert_encoding($nm_var_lab[101], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[102] = "02- Criando um Evento vinculado c/API Be Invited - 20 min.";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[102]))
{
    $nm_var_lab[102] = sc_convert_encoding($nm_var_lab[102], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[103] = "03- Complemento do Vídeo 01 -  03 min.";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[103]))
{
    $nm_var_lab[103] = sc_convert_encoding($nm_var_lab[103], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[104] = "PDF / HTML";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[104]))
{
    $nm_var_lab[104] = sc_convert_encoding($nm_var_lab[104], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[105] = "01- Introdução explicações iniciais";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[105]))
{
    $nm_var_lab[105] = sc_convert_encoding($nm_var_lab[105], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[106] = "02- Criando um Evento";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[106]))
{
    $nm_var_lab[106] = sc_convert_encoding($nm_var_lab[106], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[107] = "03- Vinculando Usuários as Empresas";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[107]))
{
    $nm_var_lab[107] = sc_convert_encoding($nm_var_lab[107], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[108] = "04- Vinculando Empresas aos Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[108]))
{
    $nm_var_lab[108] = sc_convert_encoding($nm_var_lab[108], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[109] = "05- Vinculando Usuários aos Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[109]))
{
    $nm_var_lab[109] = sc_convert_encoding($nm_var_lab[109], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[110] = "06- Vinculando Cias Aéreas aos Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[110]))
{
    $nm_var_lab[110] = sc_convert_encoding($nm_var_lab[110], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[111] = "07- Vinculando Hotéis aos Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[111]))
{
    $nm_var_lab[111] = sc_convert_encoding($nm_var_lab[111], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[112] = "08- Vinculando Públicos aos Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[112]))
{
    $nm_var_lab[112] = sc_convert_encoding($nm_var_lab[112], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[113] = "09- Vinculando Regionais aos Eventos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[113]))
{
    $nm_var_lab[113] = sc_convert_encoding($nm_var_lab[113], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[114] = "10- Outros vínculos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[114]))
{
    $nm_var_lab[114] = sc_convert_encoding($nm_var_lab[114], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[115] = "11- Criando um Bloqueio de trecho aéreo";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[115]))
{
    $nm_var_lab[115] = sc_convert_encoding($nm_var_lab[115], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[116] = "12- Criando um Bloqueio de Hotel";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[116]))
{
    $nm_var_lab[116] = sc_convert_encoding($nm_var_lab[116], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[117] = "13- Cadastrando Participantes em um Evento";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[117]))
{
    $nm_var_lab[117] = sc_convert_encoding($nm_var_lab[117], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[118] = "14- Subindo um Mailing de Participantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[118]))
{
    $nm_var_lab[118] = sc_convert_encoding($nm_var_lab[118], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[119] = "15- Cadastrando um Usuário";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[119]))
{
    $nm_var_lab[119] = sc_convert_encoding($nm_var_lab[119], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[120] = "16- Visão Geral do Sistema";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[120]))
{
    $nm_var_lab[120] = sc_convert_encoding($nm_var_lab[120], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[121] = "Sair";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[121]))
{
    $nm_var_lab[121] = sc_convert_encoding($nm_var_lab[121], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[0] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[0]))
{
    $nm_var_hint[0] = sc_convert_encoding($nm_var_hint[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[1] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[1]))
{
    $nm_var_hint[1] = sc_convert_encoding($nm_var_hint[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[2] = "Usuários Logados";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[2]))
{
    $nm_var_hint[2] = sc_convert_encoding($nm_var_hint[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[3] = "Manutenção do histórico de Logs";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[3]))
{
    $nm_var_hint[3] = sc_convert_encoding($nm_var_hint[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[4] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[4]))
{
    $nm_var_hint[4] = sc_convert_encoding($nm_var_hint[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[5] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[5]))
{
    $nm_var_hint[5] = sc_convert_encoding($nm_var_hint[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[6] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[6]))
{
    $nm_var_hint[6] = sc_convert_encoding($nm_var_hint[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[7] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[7]))
{
    $nm_var_hint[7] = sc_convert_encoding($nm_var_hint[7], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[8] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[8]))
{
    $nm_var_hint[8] = sc_convert_encoding($nm_var_hint[8], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[9] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[9]))
{
    $nm_var_hint[9] = sc_convert_encoding($nm_var_hint[9], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[10] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[10]))
{
    $nm_var_hint[10] = sc_convert_encoding($nm_var_hint[10], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[11] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[11]))
{
    $nm_var_hint[11] = sc_convert_encoding($nm_var_hint[11], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[12] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[12]))
{
    $nm_var_hint[12] = sc_convert_encoding($nm_var_hint[12], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[13] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[13]))
{
    $nm_var_hint[13] = sc_convert_encoding($nm_var_hint[13], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[14] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[14]))
{
    $nm_var_hint[14] = sc_convert_encoding($nm_var_hint[14], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[15] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[15]))
{
    $nm_var_hint[15] = sc_convert_encoding($nm_var_hint[15], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[16] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[16]))
{
    $nm_var_hint[16] = sc_convert_encoding($nm_var_hint[16], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[17] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[17]))
{
    $nm_var_hint[17] = sc_convert_encoding($nm_var_hint[17], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[18] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[18]))
{
    $nm_var_hint[18] = sc_convert_encoding($nm_var_hint[18], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[19] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[19]))
{
    $nm_var_hint[19] = sc_convert_encoding($nm_var_hint[19], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[20] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[20]))
{
    $nm_var_hint[20] = sc_convert_encoding($nm_var_hint[20], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[21] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[21]))
{
    $nm_var_hint[21] = sc_convert_encoding($nm_var_hint[21], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[22] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[22]))
{
    $nm_var_hint[22] = sc_convert_encoding($nm_var_hint[22], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[23] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[23]))
{
    $nm_var_hint[23] = sc_convert_encoding($nm_var_hint[23], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[24] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[24]))
{
    $nm_var_hint[24] = sc_convert_encoding($nm_var_hint[24], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[25] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[25]))
{
    $nm_var_hint[25] = sc_convert_encoding($nm_var_hint[25], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[26] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[26]))
{
    $nm_var_hint[26] = sc_convert_encoding($nm_var_hint[26], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[27] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[27]))
{
    $nm_var_hint[27] = sc_convert_encoding($nm_var_hint[27], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[28] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[28]))
{
    $nm_var_hint[28] = sc_convert_encoding($nm_var_hint[28], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[29] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[29]))
{
    $nm_var_hint[29] = sc_convert_encoding($nm_var_hint[29], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[30] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[30]))
{
    $nm_var_hint[30] = sc_convert_encoding($nm_var_hint[30], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[31] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[31]))
{
    $nm_var_hint[31] = sc_convert_encoding($nm_var_hint[31], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[32] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[32]))
{
    $nm_var_hint[32] = sc_convert_encoding($nm_var_hint[32], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[33] = "Histórico de Participações";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[33]))
{
    $nm_var_hint[33] = sc_convert_encoding($nm_var_hint[33], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[34] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[34]))
{
    $nm_var_hint[34] = sc_convert_encoding($nm_var_hint[34], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[35] = "Histórico de Participações";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[35]))
{
    $nm_var_hint[35] = sc_convert_encoding($nm_var_hint[35], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[36] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[36]))
{
    $nm_var_hint[36] = sc_convert_encoding($nm_var_hint[36], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[37] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[37]))
{
    $nm_var_hint[37] = sc_convert_encoding($nm_var_hint[37], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[38] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[38]))
{
    $nm_var_hint[38] = sc_convert_encoding($nm_var_hint[38], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[39] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[39]))
{
    $nm_var_hint[39] = sc_convert_encoding($nm_var_hint[39], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[40] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[40]))
{
    $nm_var_hint[40] = sc_convert_encoding($nm_var_hint[40], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[41] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[41]))
{
    $nm_var_hint[41] = sc_convert_encoding($nm_var_hint[41], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[42] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[42]))
{
    $nm_var_hint[42] = sc_convert_encoding($nm_var_hint[42], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[43] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[43]))
{
    $nm_var_hint[43] = sc_convert_encoding($nm_var_hint[43], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[44] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[44]))
{
    $nm_var_hint[44] = sc_convert_encoding($nm_var_hint[44], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[45] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[45]))
{
    $nm_var_hint[45] = sc_convert_encoding($nm_var_hint[45], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[46] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[46]))
{
    $nm_var_hint[46] = sc_convert_encoding($nm_var_hint[46], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[47] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[47]))
{
    $nm_var_hint[47] = sc_convert_encoding($nm_var_hint[47], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[48] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[48]))
{
    $nm_var_hint[48] = sc_convert_encoding($nm_var_hint[48], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[49] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[49]))
{
    $nm_var_hint[49] = sc_convert_encoding($nm_var_hint[49], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[50] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[50]))
{
    $nm_var_hint[50] = sc_convert_encoding($nm_var_hint[50], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[51] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[51]))
{
    $nm_var_hint[51] = sc_convert_encoding($nm_var_hint[51], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[52] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[52]))
{
    $nm_var_hint[52] = sc_convert_encoding($nm_var_hint[52], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[53] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[53]))
{
    $nm_var_hint[53] = sc_convert_encoding($nm_var_hint[53], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[54] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[54]))
{
    $nm_var_hint[54] = sc_convert_encoding($nm_var_hint[54], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[55] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[55]))
{
    $nm_var_hint[55] = sc_convert_encoding($nm_var_hint[55], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[56] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[56]))
{
    $nm_var_hint[56] = sc_convert_encoding($nm_var_hint[56], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[57] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[57]))
{
    $nm_var_hint[57] = sc_convert_encoding($nm_var_hint[57], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[58] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[58]))
{
    $nm_var_hint[58] = sc_convert_encoding($nm_var_hint[58], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[59] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[59]))
{
    $nm_var_hint[59] = sc_convert_encoding($nm_var_hint[59], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[60] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[60]))
{
    $nm_var_hint[60] = sc_convert_encoding($nm_var_hint[60], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[61] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[61]))
{
    $nm_var_hint[61] = sc_convert_encoding($nm_var_hint[61], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[62] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[62]))
{
    $nm_var_hint[62] = sc_convert_encoding($nm_var_hint[62], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[63] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[63]))
{
    $nm_var_hint[63] = sc_convert_encoding($nm_var_hint[63], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[64] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[64]))
{
    $nm_var_hint[64] = sc_convert_encoding($nm_var_hint[64], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[65] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[65]))
{
    $nm_var_hint[65] = sc_convert_encoding($nm_var_hint[65], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[66] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[66]))
{
    $nm_var_hint[66] = sc_convert_encoding($nm_var_hint[66], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[67] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[67]))
{
    $nm_var_hint[67] = sc_convert_encoding($nm_var_hint[67], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[68] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[68]))
{
    $nm_var_hint[68] = sc_convert_encoding($nm_var_hint[68], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[69] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[69]))
{
    $nm_var_hint[69] = sc_convert_encoding($nm_var_hint[69], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[70] = "Relatório de Substituições";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[70]))
{
    $nm_var_hint[70] = sc_convert_encoding($nm_var_hint[70], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[71] = "Relatório RSVP ";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[71]))
{
    $nm_var_hint[71] = sc_convert_encoding($nm_var_hint[71], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[72] = "Relatório Aéreos";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[72]))
{
    $nm_var_hint[72] = sc_convert_encoding($nm_var_hint[72], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[73] = "Relatório de Rooming List";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[73]))
{
    $nm_var_hint[73] = sc_convert_encoding($nm_var_hint[73], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[74] = "Room List sem acompanhantes";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[74]))
{
    $nm_var_hint[74] = sc_convert_encoding($nm_var_hint[74], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[75] = "Relatório Tranfers";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[75]))
{
    $nm_var_hint[75] = sc_convert_encoding($nm_var_hint[75], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[76] = "Transfer IN";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[76]))
{
    $nm_var_hint[76] = sc_convert_encoding($nm_var_hint[76], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[77] = "Transfer Out";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[77]))
{
    $nm_var_hint[77] = sc_convert_encoding($nm_var_hint[77], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[78] = "Transfer Local";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[78]))
{
    $nm_var_hint[78] = sc_convert_encoding($nm_var_hint[78], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[79] = "Transfer Prório";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[79]))
{
    $nm_var_hint[79] = sc_convert_encoding($nm_var_hint[79], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[80] = "Relatório Geral";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[80]))
{
    $nm_var_hint[80] = sc_convert_encoding($nm_var_hint[80], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[81] = "Atualizações Via Mailling";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[81]))
{
    $nm_var_hint[81] = sc_convert_encoding($nm_var_hint[81], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[82] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[82]))
{
    $nm_var_hint[82] = sc_convert_encoding($nm_var_hint[82], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[83] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[83]))
{
    $nm_var_hint[83] = sc_convert_encoding($nm_var_hint[83], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[84] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[84]))
{
    $nm_var_hint[84] = sc_convert_encoding($nm_var_hint[84], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[85] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[85]))
{
    $nm_var_hint[85] = sc_convert_encoding($nm_var_hint[85], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[86] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[86]))
{
    $nm_var_hint[86] = sc_convert_encoding($nm_var_hint[86], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[87] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[87]))
{
    $nm_var_hint[87] = sc_convert_encoding($nm_var_hint[87], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[88] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[88]))
{
    $nm_var_hint[88] = sc_convert_encoding($nm_var_hint[88], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[89] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[89]))
{
    $nm_var_hint[89] = sc_convert_encoding($nm_var_hint[89], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[90] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[90]))
{
    $nm_var_hint[90] = sc_convert_encoding($nm_var_hint[90], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[91] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[91]))
{
    $nm_var_hint[91] = sc_convert_encoding($nm_var_hint[91], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[92] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[92]))
{
    $nm_var_hint[92] = sc_convert_encoding($nm_var_hint[92], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[93] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[93]))
{
    $nm_var_hint[93] = sc_convert_encoding($nm_var_hint[93], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[94] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[94]))
{
    $nm_var_hint[94] = sc_convert_encoding($nm_var_hint[94], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[95] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[95]))
{
    $nm_var_hint[95] = sc_convert_encoding($nm_var_hint[95], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[96] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[96]))
{
    $nm_var_hint[96] = sc_convert_encoding($nm_var_hint[96], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[97] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[97]))
{
    $nm_var_hint[97] = sc_convert_encoding($nm_var_hint[97], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[98] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[98]))
{
    $nm_var_hint[98] = sc_convert_encoding($nm_var_hint[98], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[99] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[99]))
{
    $nm_var_hint[99] = sc_convert_encoding($nm_var_hint[99], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[100] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[100]))
{
    $nm_var_hint[100] = sc_convert_encoding($nm_var_hint[100], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[101] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[101]))
{
    $nm_var_hint[101] = sc_convert_encoding($nm_var_hint[101], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[102] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[102]))
{
    $nm_var_hint[102] = sc_convert_encoding($nm_var_hint[102], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[103] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[103]))
{
    $nm_var_hint[103] = sc_convert_encoding($nm_var_hint[103], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[104] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[104]))
{
    $nm_var_hint[104] = sc_convert_encoding($nm_var_hint[104], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[105] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[105]))
{
    $nm_var_hint[105] = sc_convert_encoding($nm_var_hint[105], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[106] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[106]))
{
    $nm_var_hint[106] = sc_convert_encoding($nm_var_hint[106], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[107] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[107]))
{
    $nm_var_hint[107] = sc_convert_encoding($nm_var_hint[107], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[108] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[108]))
{
    $nm_var_hint[108] = sc_convert_encoding($nm_var_hint[108], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[109] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[109]))
{
    $nm_var_hint[109] = sc_convert_encoding($nm_var_hint[109], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[110] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[110]))
{
    $nm_var_hint[110] = sc_convert_encoding($nm_var_hint[110], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[111] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[111]))
{
    $nm_var_hint[111] = sc_convert_encoding($nm_var_hint[111], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[112] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[112]))
{
    $nm_var_hint[112] = sc_convert_encoding($nm_var_hint[112], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[113] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[113]))
{
    $nm_var_hint[113] = sc_convert_encoding($nm_var_hint[113], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[114] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[114]))
{
    $nm_var_hint[114] = sc_convert_encoding($nm_var_hint[114], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[115] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[115]))
{
    $nm_var_hint[115] = sc_convert_encoding($nm_var_hint[115], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[116] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[116]))
{
    $nm_var_hint[116] = sc_convert_encoding($nm_var_hint[116], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[117] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[117]))
{
    $nm_var_hint[117] = sc_convert_encoding($nm_var_hint[117], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[118] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[118]))
{
    $nm_var_hint[118] = sc_convert_encoding($nm_var_hint[118], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[119] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[119]))
{
    $nm_var_hint[119] = sc_convert_encoding($nm_var_hint[119], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[120] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[120]))
{
    $nm_var_hint[120] = sc_convert_encoding($nm_var_hint[120], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[121] = "Encerra a Sessão";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[121]))
{
    $nm_var_hint[121] = sc_convert_encoding($nm_var_hint[121], $_SESSION['scriptcase']['charset'], "UTF-8");
}
$saida_apl = $_SESSION['scriptcase']['sc_saida_administrativo_menu'];
$administrativo_menu_menuData['data'] .= "item_1|.|" . $nm_var_lab[0] . "||" . $nm_var_hint[0] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_3|..|" . $nm_var_lab[1] . "|administrativo_menu_form_php.php?sc_item_menu=item_3&sc_apl_menu=grid_usuarios_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[1] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_3|..|" . $nm_var_lab[1] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_77|..|" . $nm_var_lab[2] . "|administrativo_menu_form_php.php?sc_item_menu=item_77&sc_apl_menu=grid_rsvpses_log&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[2] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_77|..|" . $nm_var_lab[2] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log_n']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log_n']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_78|..|" . $nm_var_lab[3] . "|administrativo_menu_form_php.php?sc_item_menu=item_78&sc_apl_menu=grid_rsvpses_log_n&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[3] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_78|..|" . $nm_var_lab[3] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp_2fa']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp_2fa']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_99|..|" . $nm_var_lab[4] . "|administrativo_menu_form_php.php?sc_item_menu=item_99&sc_apl_menu=grid_usuarios_rsvp_2fa&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[4] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_99|..|" . $nm_var_lab[4] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_100|..|" . $nm_var_lab[5] . "|administrativo_menu_form_php.php?sc_item_menu=item_100&sc_apl_menu=grid_rsvp_log&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[5] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_100|..|" . $nm_var_lab[5] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log_api']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log_api']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_101|..|" . $nm_var_lab[6] . "|administrativo_menu_form_php.php?sc_item_menu=item_101&sc_apl_menu=grid_rsvp_log_api&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[6] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_101|..|" . $nm_var_lab[6] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_bkp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_bkp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_102|..|" . $nm_var_lab[7] . "|administrativo_menu_form_php.php?sc_item_menu=item_102&sc_apl_menu=control_bkp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[7] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_102|..|" . $nm_var_lab[7] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_2|.|" . $nm_var_lab[8] . "||" . $nm_var_hint[8] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_acomodacoes']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_acomodacoes']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_5|..|" . $nm_var_lab[9] . "|administrativo_menu_form_php.php?sc_item_menu=item_5&sc_apl_menu=grid_tbl_acomodacoes&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[9] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_5|..|" . $nm_var_lab[9] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_acomod']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_acomod']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_6|..|" . $nm_var_lab[10] . "|administrativo_menu_form_php.php?sc_item_menu=item_6&sc_apl_menu=grid_tbl_categ_acomod&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[10] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_6|..|" . $nm_var_lab[10] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_aeroportos']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_aeroportos']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_7|..|" . $nm_var_lab[11] . "|administrativo_menu_form_php.php?sc_item_menu=item_7&sc_apl_menu=grid_tbl_aeroportos&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[11] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_7|..|" . $nm_var_lab[11] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_aeroporto']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_aeroporto']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_79|..|" . $nm_var_lab[12] . "|administrativo_menu_form_php.php?sc_item_menu=item_79&sc_apl_menu=grid_aeroporto&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[12] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_79|..|" . $nm_var_lab[12] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cia_aereas']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cia_aereas']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_8|..|" . $nm_var_lab[13] . "|administrativo_menu_form_php.php?sc_item_menu=item_8&sc_apl_menu=grid_tbl_cia_aereas&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[13] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_8|..|" . $nm_var_lab[13] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cidades']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cidades']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_9|..|" . $nm_var_lab[14] . "|administrativo_menu_form_php.php?sc_item_menu=item_9&sc_apl_menu=grid_tbl_cidades&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[14] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_9|..|" . $nm_var_lab[14] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_fornecedores']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_fornecedores']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_10|..|" . $nm_var_lab[15] . "|administrativo_menu_form_php.php?sc_item_menu=item_10&sc_apl_menu=grid_tbl_fornecedores&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[15] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_10|..|" . $nm_var_lab[15] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_11|..|" . $nm_var_lab[16] . "|administrativo_menu_form_php.php?sc_item_menu=item_11&sc_apl_menu=grid_tbl_hoteis&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[16] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_11|..|" . $nm_var_lab[16] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_hoteis']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_hoteis']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_12|..|" . $nm_var_lab[17] . "|administrativo_menu_form_php.php?sc_item_menu=item_12&sc_apl_menu=grid_tbl_categ_hoteis&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[17] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_12|..|" . $nm_var_lab[17] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis_class']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis_class']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_13|..|" . $nm_var_lab[18] . "|administrativo_menu_form_php.php?sc_item_menu=item_13&sc_apl_menu=grid_tbl_hoteis_class&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[18] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_13|..|" . $nm_var_lab[18] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_rede_hoteis']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_rede_hoteis']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_14|..|" . $nm_var_lab[19] . "|administrativo_menu_form_php.php?sc_item_menu=item_14&sc_apl_menu=grid_tbl_rede_hoteis&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[19] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_14|..|" . $nm_var_lab[19] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_locacoes']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_locacoes']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_15|..|" . $nm_var_lab[20] . "|administrativo_menu_form_php.php?sc_item_menu=item_15&sc_apl_menu=grid_tbl_locacoes&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[20] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_15|..|" . $nm_var_lab[20] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_paises']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_paises']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_16|..|" . $nm_var_lab[21] . "|administrativo_menu_form_php.php?sc_item_menu=item_16&sc_apl_menu=grid_tbl_paises&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[21] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_16|..|" . $nm_var_lab[21] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_ufs']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_ufs']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_17|..|" . $nm_var_lab[22] . "|administrativo_menu_form_php.php?sc_item_menu=item_17&sc_apl_menu=grid_tbl_ufs&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[22] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_17|..|" . $nm_var_lab[22] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_19|.|" . $nm_var_lab[23] . "||" . $nm_var_hint[23] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_empresas_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_empresas_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_20|..|" . $nm_var_lab[24] . "|administrativo_menu_form_php.php?sc_item_menu=item_20&sc_apl_menu=grid_empresas_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[24] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_20|..|" . $nm_var_lab[24] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_opcionais']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_opcionais']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_21|..|" . $nm_var_lab[25] . "|administrativo_menu_form_php.php?sc_item_menu=item_21&sc_apl_menu=grid_tbl_opcionais&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[25] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_21|..|" . $nm_var_lab[25] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pagamentos_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pagamentos_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_22|..|" . $nm_var_lab[26] . "|administrativo_menu_form_php.php?sc_item_menu=item_22&sc_apl_menu=grid_pagamentos_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[26] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_22|..|" . $nm_var_lab[26] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_23|..|" . $nm_var_lab[27] . "|administrativo_menu_form_php.php?sc_item_menu=item_23&sc_apl_menu=grid_pessoas_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[27] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_23|..|" . $nm_var_lab[27] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_programacao']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_programacao']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_24|..|" . $nm_var_lab[28] . "|administrativo_menu_form_php.php?sc_item_menu=item_24&sc_apl_menu=grid_tbl_programacao&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[28] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_24|..|" . $nm_var_lab[28] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_publico_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_publico_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_25|..|" . $nm_var_lab[29] . "|administrativo_menu_form_php.php?sc_item_menu=item_25&sc_apl_menu=grid_publico_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[29] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_25|..|" . $nm_var_lab[29] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_regionais']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_regionais']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_26|..|" . $nm_var_lab[30] . "|administrativo_menu_form_php.php?sc_item_menu=item_26&sc_apl_menu=grid_tbl_regionais&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[30] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_26|..|" . $nm_var_lab[30] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_tours']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_tours']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_27|..|" . $nm_var_lab[31] . "|administrativo_menu_form_php.php?sc_item_menu=item_27&sc_apl_menu=grid_tbl_tours&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[31] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_27|..|" . $nm_var_lab[31] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_modelo_mailling_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_modelo_mailling_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_82|..|" . $nm_var_lab[32] . "|administrativo_menu_form_php.php?sc_item_menu=item_82&sc_apl_menu=grid_modelo_mailling_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[32] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_82|..|" . $nm_var_lab[32] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_66|..|" . $nm_var_lab[33] . "||" . $nm_var_hint[33] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_acompanhantes_rsvp_2']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_acompanhantes_rsvp_2']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_67|...|" . $nm_var_lab[34] . "|administrativo_menu_form_php.php?sc_item_menu=item_67&sc_apl_menu=grid_acompanhantes_rsvp_2&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[34] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_67|...|" . $nm_var_lab[34] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_participantes_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_participantes_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_68|...|" . $nm_var_lab[35] . "|administrativo_menu_form_php.php?sc_item_menu=item_68&sc_apl_menu=grid_participantes_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[35] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_68|...|" . $nm_var_lab[35] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_84|..|" . $nm_var_lab[36] . "||" . $nm_var_hint[36] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_85|...|" . $nm_var_lab[37] . "||" . $nm_var_hint[37] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_bloq_ac']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_bloq_ac']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_86|....|" . $nm_var_lab[38] . "|administrativo_menu_form_php.php?sc_item_menu=item_86&sc_apl_menu=control_bloq_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[38] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_86|....|" . $nm_var_lab[38] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar1']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar1']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_95|....|" . $nm_var_lab[39] . "|administrativo_menu_form_php.php?sc_item_menu=item_95&sc_apl_menu=form_hospedagem_rsvp_ar1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[39] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_95|....|" . $nm_var_lab[39] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_87|....|" . $nm_var_lab[40] . "|administrativo_menu_form_php.php?sc_item_menu=item_87&sc_apl_menu=form_hospedagem_rsvp_ar&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[40] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_87|....|" . $nm_var_lab[40] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_88|...|" . $nm_var_lab[41] . "||" . $nm_var_hint[41] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_pub_ac']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_pub_ac']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_90|....|" . $nm_var_lab[42] . "|administrativo_menu_form_php.php?sc_item_menu=item_90&sc_apl_menu=control_pub_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[42] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_90|....|" . $nm_var_lab[42] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_participantes_rsvp_ar']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_participantes_rsvp_ar']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_89|....|" . $nm_var_lab[43] . "|administrativo_menu_form_php.php?sc_item_menu=item_89&sc_apl_menu=form_participantes_rsvp_ar&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[43] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_89|....|" . $nm_var_lab[43] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_part_ac']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_part_ac']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_96|...|" . $nm_var_lab[44] . "|administrativo_menu_form_php.php?sc_item_menu=item_96&sc_apl_menu=control_part_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[44] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_96|...|" . $nm_var_lab[44] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_voucher_ac']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_voucher_ac']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_97|...|" . $nm_var_lab[45] . "|administrativo_menu_form_php.php?sc_item_menu=item_97&sc_apl_menu=control_voucher_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[45] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_97|...|" . $nm_var_lab[45] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_mail_ac']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_mail_ac']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_98|...|" . $nm_var_lab[46] . "|administrativo_menu_form_php.php?sc_item_menu=item_98&sc_apl_menu=control_mail_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[46] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_98|...|" . $nm_var_lab[46] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_3']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_3']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_104|...|" . $nm_var_lab[47] . "|administrativo_menu_form_php.php?sc_item_menu=item_104&sc_apl_menu=grid_pessoas_rsvp_3&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[47] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_104|...|" . $nm_var_lab[47] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_spessoas']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_spessoas']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_103|...|" . $nm_var_lab[48] . "|administrativo_menu_form_php.php?sc_item_menu=item_103&sc_apl_menu=control_spessoas&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[48] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_103|...|" . $nm_var_lab[48] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_log_bkp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_log_bkp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_105|...|" . $nm_var_lab[49] . "|administrativo_menu_form_php.php?sc_item_menu=item_105&sc_apl_menu=control_log_bkp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[49] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_105|...|" . $nm_var_lab[49] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_1']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_1']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_94|..|" . $nm_var_lab[50] . "|administrativo_menu_form_php.php?sc_item_menu=item_94&sc_apl_menu=grid_pessoas_rsvp_1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[50] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_94|..|" . $nm_var_lab[50] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_28|.|" . $nm_var_lab[51] . "||" . $nm_var_hint[51] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_29|..|" . $nm_var_lab[52] . "|administrativo_menu_form_php.php?sc_item_menu=item_29&sc_apl_menu=grid_eventos_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[52] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_29|..|" . $nm_var_lab[52] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_ciasaer_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_ciasaer_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_34|..|" . $nm_var_lab[53] . "|administrativo_menu_form_php.php?sc_item_menu=item_34&sc_apl_menu=form_eventos_ciasaer_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[53] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_34|..|" . $nm_var_lab[53] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_empresas_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_empresas_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_35|..|" . $nm_var_lab[54] . "|administrativo_menu_form_php.php?sc_item_menu=item_35&sc_apl_menu=form_eventos_empresas_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[54] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_35|..|" . $nm_var_lab[54] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_hoteis_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_hoteis_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_36|..|" . $nm_var_lab[55] . "|administrativo_menu_form_php.php?sc_item_menu=item_36&sc_apl_menu=form_eventos_hoteis_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[55] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_36|..|" . $nm_var_lab[55] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_publicos_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_publicos_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_37|..|" . $nm_var_lab[56] . "|administrativo_menu_form_php.php?sc_item_menu=item_37&sc_apl_menu=form_eventos_publicos_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[56] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_37|..|" . $nm_var_lab[56] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_regionais_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_regionais_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_38|..|" . $nm_var_lab[57] . "|administrativo_menu_form_php.php?sc_item_menu=item_38&sc_apl_menu=form_eventos_regionais_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[57] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_38|..|" . $nm_var_lab[57] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_tours_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_tours_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_39|..|" . $nm_var_lab[58] . "|administrativo_menu_form_php.php?sc_item_menu=item_39&sc_apl_menu=form_eventos_tours_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[58] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_39|..|" . $nm_var_lab[58] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_empresas_usr_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_empresas_usr_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_40|..|" . $nm_var_lab[59] . "|administrativo_menu_form_php.php?sc_item_menu=item_40&sc_apl_menu=form_empresas_usr_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[59] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_40|..|" . $nm_var_lab[59] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_usuarios_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_usuarios_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_41|..|" . $nm_var_lab[60] . "|administrativo_menu_form_php.php?sc_item_menu=item_41&sc_apl_menu=form_eventos_usuarios_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[60] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_41|..|" . $nm_var_lab[60] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_aereo_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_aereo_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_42|..|" . $nm_var_lab[61] . "|administrativo_menu_form_php.php?sc_item_menu=item_42&sc_apl_menu=grid_bloqueio_aereo_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[61] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_42|..|" . $nm_var_lab[61] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_hoteis_rsvp_1']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_hoteis_rsvp_1']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_80|..|" . $nm_var_lab[62] . "|administrativo_menu_form_php.php?sc_item_menu=item_80&sc_apl_menu=grid_bloqueio_hoteis_rsvp_1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[62] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_80|..|" . $nm_var_lab[62] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_opcionais_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_opcionais_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_43|..|" . $nm_var_lab[63] . "|administrativo_menu_form_php.php?sc_item_menu=item_43&sc_apl_menu=grid_eventos_opcionais_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[63] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_43|..|" . $nm_var_lab[63] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_programa_sf']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_programa_sf']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_44|..|" . $nm_var_lab[64] . "|administrativo_menu_form_php.php?sc_item_menu=item_44&sc_apl_menu=form_eventos_programa_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[64] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_44|..|" . $nm_var_lab[64] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_52|..|" . $nm_var_lab[65] . "|administrativo_menu_form_php.php?sc_item_menu=item_52&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[65] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_52|..|" . $nm_var_lab[65] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_confirmacao_viagem_rsvp_1']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_confirmacao_viagem_rsvp_1']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_81|..|" . $nm_var_lab[66] . "|administrativo_menu_form_php.php?sc_item_menu=item_81&sc_apl_menu=grid_confirmacao_viagem_rsvp_1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[66] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_81|..|" . $nm_var_lab[66] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_74|..|" . $nm_var_lab[67] . "||" . $nm_var_hint[67] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_51|..|" . $nm_var_lab[68] . "|administrativo_menu_form_php.php?sc_item_menu=item_51&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[68] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_51|..|" . $nm_var_lab[68] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_31|.|" . $nm_var_lab[69] . "||" . $nm_var_hint[69] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_46|..|" . $nm_var_lab[70] . "|administrativo_menu_form_php.php?sc_item_menu=item_46&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[70] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_46|..|" . $nm_var_lab[70] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_47|..|" . $nm_var_lab[71] . "|administrativo_menu_form_php.php?sc_item_menu=item_47&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[71] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_47|..|" . $nm_var_lab[71] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_49|..|" . $nm_var_lab[72] . "|administrativo_menu_form_php.php?sc_item_menu=item_49&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[72] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_49|..|" . $nm_var_lab[72] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_72|..|" . $nm_var_lab[73] . "|administrativo_menu_form_php.php?sc_item_menu=item_72&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[73] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_72|..|" . $nm_var_lab[73] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_76|..|" . $nm_var_lab[74] . "|administrativo_menu_form_php.php?sc_item_menu=item_76&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[74] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_76|..|" . $nm_var_lab[74] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_50|..|" . $nm_var_lab[75] . "||" . $nm_var_hint[75] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_58|...|" . $nm_var_lab[76] . "|administrativo_menu_form_php.php?sc_item_menu=item_58&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[76] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_58|...|" . $nm_var_lab[76] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_60|...|" . $nm_var_lab[77] . "|administrativo_menu_form_php.php?sc_item_menu=item_60&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[77] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_60|...|" . $nm_var_lab[77] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_62|...|" . $nm_var_lab[78] . "|administrativo_menu_form_php.php?sc_item_menu=item_62&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[78] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_62|...|" . $nm_var_lab[78] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_63|...|" . $nm_var_lab[79] . "|administrativo_menu_form_php.php?sc_item_menu=item_63&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[79] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_63|...|" . $nm_var_lab[79] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_71|..|" . $nm_var_lab[80] . "|administrativo_menu_form_php.php?sc_item_menu=item_71&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[80] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_71|..|" . $nm_var_lab[80] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_mailling_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_mailling_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_53|..|" . $nm_var_lab[81] . "|administrativo_menu_form_php.php?sc_item_menu=item_53&sc_apl_menu=grid_mailling_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[81] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_53|..|" . $nm_var_lab[81] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_inconsistmailling']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_inconsistmailling']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_73|..|" . $nm_var_lab[82] . "|administrativo_menu_form_php.php?sc_item_menu=item_73&sc_apl_menu=grid_inconsistmailling&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[82] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_73|..|" . $nm_var_lab[82] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_75|..|" . $nm_var_lab[83] . "|administrativo_menu_form_php.php?sc_item_menu=item_75&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[83] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_75|..|" . $nm_var_lab[83] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_111|..|" . $nm_var_lab[84] . "||" . $nm_var_hint[84] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_117|...|" . $nm_var_lab[85] . "|administrativo_menu_form_php.php?sc_item_menu=item_117&sc_apl_menu=chart_aereos_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[85] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_117|...|" . $nm_var_lab[85] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp_va']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp_va']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_116|...|" . $nm_var_lab[86] . "|administrativo_menu_form_php.php?sc_item_menu=item_116&sc_apl_menu=chart_aereos_rsvp_va&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[86] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_116|...|" . $nm_var_lab[86] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_115|...|" . $nm_var_lab[87] . "|administrativo_menu_form_php.php?sc_item_menu=item_115&sc_apl_menu=chart_hospedagem_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[87] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_115|...|" . $nm_var_lab[87] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp_vh']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp_vh']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_114|...|" . $nm_var_lab[88] . "|administrativo_menu_form_php.php?sc_item_menu=item_114&sc_apl_menu=chart_hospedagem_rsvp_vh&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[88] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_114|...|" . $nm_var_lab[88] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['chart_participantes_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_participantes_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_113|...|" . $nm_var_lab[89] . "|administrativo_menu_form_php.php?sc_item_menu=item_113&sc_apl_menu=chart_participantes_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[89] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_113|...|" . $nm_var_lab[89] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['chart_presencas_rsvp']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_presencas_rsvp']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_112|...|" . $nm_var_lab[90] . "|administrativo_menu_form_php.php?sc_item_menu=item_112&sc_apl_menu=chart_presencas_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[90] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_112|...|" . $nm_var_lab[90] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_118|.|" . $nm_var_lab[91] . "||" . $nm_var_hint[91] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_122|..|" . $nm_var_lab[92] . "||" . $nm_var_hint[92] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_123|...|" . $nm_var_lab[93] . "|administrativo_menu_form_php.php?sc_item_menu=item_123&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[93] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_123|...|" . $nm_var_lab[93] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_124|...|" . $nm_var_lab[94] . "|administrativo_menu_form_php.php?sc_item_menu=item_124&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[94] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_124|...|" . $nm_var_lab[94] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_121|..|" . $nm_var_lab[95] . "||" . $nm_var_hint[95] . "||_self|\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_126|...|" . $nm_var_lab[96] . "|administrativo_menu_form_php.php?sc_item_menu=item_126&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[96] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_126|...|" . $nm_var_lab[96] . "||||_self|disabled\n";
}
if (isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_125|...|" . $nm_var_lab[97] . "|administrativo_menu_form_php.php?sc_item_menu=item_125&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[97] . "||" . $this->administrativo_menu_target('_self') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_125|...|" . $nm_var_lab[97] . "||||_self|disabled\n";
}
$administrativo_menu_menuData['data'] .= "item_128|..|" . $nm_var_lab[98] . "||" . $nm_var_hint[98] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_129|.|" . $nm_var_lab[99] . "||" . $nm_var_hint[99] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_130|..|" . $nm_var_lab[100] . "||" . $nm_var_hint[100] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_149|...|" . $nm_var_lab[101] . "||" . $nm_var_hint[101] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_132|...|" . $nm_var_lab[102] . "|administrativo_menu_form_php.php?sc_item_menu=item_132&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/mod-01 RSVP - inclusao de eventos.mp4&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[102] . "||" . $this->administrativo_menu_target('_blank') . "|" . "\n";
$administrativo_menu_menuData['data'] .= "item_133|...|" . $nm_var_lab[103] . "|administrativo_menu_form_php.php?sc_item_menu=item_133&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/mod-02 RSVP - inclusao de eventos.mp4&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[103] . "||" . $this->administrativo_menu_target('_blank') . "|" . "\n";
$administrativo_menu_menuData['data'] .= "item_131|..|" . $nm_var_lab[104] . "||" . $nm_var_hint[104] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_148|...|" . $nm_var_lab[105] . "||" . $nm_var_hint[105] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_135|...|" . $nm_var_lab[106] . "|administrativo_menu_form_php.php?sc_item_menu=item_135&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/02-Criando Eventos com ou sem vinculo com o aplicativo Be Invited.html&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[106] . "||" . $this->administrativo_menu_target('_blank') . "|" . "\n";
$administrativo_menu_menuData['data'] .= "item_136|...|" . $nm_var_lab[107] . "||" . $nm_var_hint[107] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_137|...|" . $nm_var_lab[108] . "||" . $nm_var_hint[108] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_138|...|" . $nm_var_lab[109] . "||" . $nm_var_hint[109] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_139|...|" . $nm_var_lab[110] . "||" . $nm_var_hint[110] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_140|...|" . $nm_var_lab[111] . "||" . $nm_var_hint[111] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_141|...|" . $nm_var_lab[112] . "||" . $nm_var_hint[112] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_142|...|" . $nm_var_lab[113] . "||" . $nm_var_hint[113] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_143|...|" . $nm_var_lab[114] . "||" . $nm_var_hint[114] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_144|...|" . $nm_var_lab[115] . "||" . $nm_var_hint[115] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_145|...|" . $nm_var_lab[116] . "||" . $nm_var_hint[116] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_146|...|" . $nm_var_lab[117] . "||" . $nm_var_hint[117] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_147|...|" . $nm_var_lab[118] . "||" . $nm_var_hint[118] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_150|...|" . $nm_var_lab[119] . "||" . $nm_var_hint[119] . "||_self|\n";
$administrativo_menu_menuData['data'] .= "item_134|...|" . $nm_var_lab[120] . "|administrativo_menu_form_php.php?sc_item_menu=item_134&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/visao geral.html&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[120] . "||" . $this->administrativo_menu_target('_blank') . "|" . "\n";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['blank_limpaRel']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['blank_limpaRel']) == "on")
{
    $administrativo_menu_menuData['data'] .= "item_69|.|" . $nm_var_lab[121] . "|administrativo_menu_form_php.php?sc_item_menu=item_69&sc_apl_menu=blank_limpaRel&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[121] . "||" . $this->administrativo_menu_target('_parent') . "|" . "\n";
}
else
{
    $administrativo_menu_menuData['data'] .= "item_69|.|" . $nm_var_lab[121] . "||||_parent|disabled\n";
}
if(isset($_SESSION['scriptcase']['force_menu_orientacao']) && !empty($_SESSION['scriptcase']['force_menu_orientacao']))
{
    $this->menu_orientacao = $_SESSION['scriptcase']['force_menu_orientacao'];
}
elseif($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
    $this->menu_orientacao = 'horizontal';
    $this->mobile_menu_toolbar = '';
}

$administrativo_menu_menuData['data'] = array();
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[0] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[0] . "",
    'id'       => "item_1",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_1",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_3&sc_apl_menu=grid_usuarios_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[1] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[1] . "",
        'id'       => "item_3",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_3",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_77&sc_apl_menu=grid_rsvpses_log&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[2] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[2] . "",
        'id'       => "item_77",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_77",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_78&sc_apl_menu=grid_rsvpses_log_n&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log_n']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvpses_log_n']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[3] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[3] . "",
        'id'       => "item_78",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_78",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_99&sc_apl_menu=grid_usuarios_rsvp_2fa&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp_2fa']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_usuarios_rsvp_2fa']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[4] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[4] . "",
        'id'       => "item_99",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_99",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_100&sc_apl_menu=grid_rsvp_log&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[5] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[5] . "",
        'id'       => "item_100",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_100",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_101&sc_apl_menu=grid_rsvp_log_api&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log_api']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_rsvp_log_api']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[6] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[6] . "",
        'id'       => "item_101",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_101",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_102&sc_apl_menu=control_bkp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_bkp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_bkp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[7] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[7] . "",
        'id'       => "item_102",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_102",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[8] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[8] . "",
    'id'       => "item_2",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_2",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_5&sc_apl_menu=grid_tbl_acomodacoes&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_acomodacoes']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_acomodacoes']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[9] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[9] . "",
        'id'       => "item_5",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_5",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_6&sc_apl_menu=grid_tbl_categ_acomod&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_acomod']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_acomod']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[10] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[10] . "",
        'id'       => "item_6",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_6",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_7&sc_apl_menu=grid_tbl_aeroportos&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_aeroportos']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_aeroportos']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[11] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[11] . "",
        'id'       => "item_7",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_7",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_79&sc_apl_menu=grid_aeroporto&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_aeroporto']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_aeroporto']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[12] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[12] . "",
        'id'       => "item_79",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_79",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_8&sc_apl_menu=grid_tbl_cia_aereas&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cia_aereas']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cia_aereas']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[13] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[13] . "",
        'id'       => "item_8",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_8",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_9&sc_apl_menu=grid_tbl_cidades&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cidades']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_cidades']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[14] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[14] . "",
        'id'       => "item_9",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_9",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_10&sc_apl_menu=grid_tbl_fornecedores&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_fornecedores']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_fornecedores']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[15] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[15] . "",
        'id'       => "item_10",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_10",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_11&sc_apl_menu=grid_tbl_hoteis&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[16] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[16] . "",
        'id'       => "item_11",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_11",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_12&sc_apl_menu=grid_tbl_categ_hoteis&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_hoteis']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_categ_hoteis']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[17] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[17] . "",
        'id'       => "item_12",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_12",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_13&sc_apl_menu=grid_tbl_hoteis_class&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis_class']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_hoteis_class']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[18] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[18] . "",
        'id'       => "item_13",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_13",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_14&sc_apl_menu=grid_tbl_rede_hoteis&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_rede_hoteis']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_rede_hoteis']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[19] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[19] . "",
        'id'       => "item_14",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_14",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_15&sc_apl_menu=grid_tbl_locacoes&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_locacoes']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_locacoes']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[20] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[20] . "",
        'id'       => "item_15",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_15",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_16&sc_apl_menu=grid_tbl_paises&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_paises']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_paises']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[21] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[21] . "",
        'id'       => "item_16",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_16",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_17&sc_apl_menu=grid_tbl_ufs&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_ufs']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_ufs']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[22] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[22] . "",
        'id'       => "item_17",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_17",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[23] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[23] . "",
    'id'       => "item_19",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_19",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_20&sc_apl_menu=grid_empresas_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_empresas_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_empresas_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[24] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[24] . "",
        'id'       => "item_20",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_20",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_21&sc_apl_menu=grid_tbl_opcionais&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_opcionais']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_opcionais']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[25] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[25] . "",
        'id'       => "item_21",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_21",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_22&sc_apl_menu=grid_pagamentos_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pagamentos_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pagamentos_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[26] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[26] . "",
        'id'       => "item_22",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_22",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_23&sc_apl_menu=grid_pessoas_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[27] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[27] . "",
        'id'       => "item_23",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_23",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_24&sc_apl_menu=grid_tbl_programacao&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_programacao']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_programacao']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[28] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[28] . "",
        'id'       => "item_24",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_24",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_25&sc_apl_menu=grid_publico_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_publico_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_publico_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[29] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[29] . "",
        'id'       => "item_25",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_25",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_26&sc_apl_menu=grid_tbl_regionais&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_regionais']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_regionais']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[30] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[30] . "",
        'id'       => "item_26",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_26",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_27&sc_apl_menu=grid_tbl_tours&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_tours']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_tbl_tours']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[31] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[31] . "",
        'id'       => "item_27",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_27",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_82&sc_apl_menu=grid_modelo_mailling_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_modelo_mailling_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_modelo_mailling_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[32] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[32] . "",
        'id'       => "item_82",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_82",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[33] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[33] . "",
    'id'       => "item_66",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_66",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_67&sc_apl_menu=grid_acompanhantes_rsvp_2&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_acompanhantes_rsvp_2']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_acompanhantes_rsvp_2']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[34] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[34] . "",
        'id'       => "item_67",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_67",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_68&sc_apl_menu=grid_participantes_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_participantes_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_participantes_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[35] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[35] . "",
        'id'       => "item_68",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_68",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[36] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[36] . "",
    'id'       => "item_84",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_84",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[37] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[37] . "",
    'id'       => "item_85",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_85",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_86&sc_apl_menu=control_bloq_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_bloq_ac']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_bloq_ac']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[38] . "",
        'level'    => "3",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[38] . "",
        'id'       => "item_86",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_86",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_95&sc_apl_menu=form_hospedagem_rsvp_ar1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar1']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar1']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[39] . "",
        'level'    => "3",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[39] . "",
        'id'       => "item_95",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_95",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_87&sc_apl_menu=form_hospedagem_rsvp_ar&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_hospedagem_rsvp_ar']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[40] . "",
        'level'    => "3",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[40] . "",
        'id'       => "item_87",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_87",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[41] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[41] . "",
    'id'       => "item_88",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_88",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_90&sc_apl_menu=control_pub_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_pub_ac']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_pub_ac']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[42] . "",
        'level'    => "3",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[42] . "",
        'id'       => "item_90",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_90",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_89&sc_apl_menu=form_participantes_rsvp_ar&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_participantes_rsvp_ar']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_participantes_rsvp_ar']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[43] . "",
        'level'    => "3",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[43] . "",
        'id'       => "item_89",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_89",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_96&sc_apl_menu=control_part_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_part_ac']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_part_ac']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[44] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[44] . "",
        'id'       => "item_96",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_96",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_97&sc_apl_menu=control_voucher_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_voucher_ac']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_voucher_ac']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[45] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[45] . "",
        'id'       => "item_97",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_97",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_98&sc_apl_menu=control_mail_ac&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_mail_ac']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_mail_ac']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[46] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[46] . "",
        'id'       => "item_98",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_98",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_104&sc_apl_menu=grid_pessoas_rsvp_3&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_3']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_3']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[47] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[47] . "",
        'id'       => "item_104",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_104",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_103&sc_apl_menu=control_spessoas&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_spessoas']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_spessoas']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[48] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[48] . "",
        'id'       => "item_103",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_103",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_105&sc_apl_menu=control_log_bkp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_log_bkp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_log_bkp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[49] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[49] . "",
        'id'       => "item_105",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_105",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_94&sc_apl_menu=grid_pessoas_rsvp_1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_1']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_pessoas_rsvp_1']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[50] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[50] . "",
        'id'       => "item_94",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_94",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[51] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[51] . "",
    'id'       => "item_28",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_28",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_29&sc_apl_menu=grid_eventos_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[52] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[52] . "",
        'id'       => "item_29",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_29",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_34&sc_apl_menu=form_eventos_ciasaer_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_ciasaer_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_ciasaer_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[53] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[53] . "",
        'id'       => "item_34",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_34",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_35&sc_apl_menu=form_eventos_empresas_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_empresas_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_empresas_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[54] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[54] . "",
        'id'       => "item_35",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_35",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_36&sc_apl_menu=form_eventos_hoteis_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_hoteis_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_hoteis_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[55] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[55] . "",
        'id'       => "item_36",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_36",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_37&sc_apl_menu=form_eventos_publicos_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_publicos_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_publicos_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[56] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[56] . "",
        'id'       => "item_37",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_37",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_38&sc_apl_menu=form_eventos_regionais_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_regionais_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_regionais_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[57] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[57] . "",
        'id'       => "item_38",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_38",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_39&sc_apl_menu=form_eventos_tours_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_tours_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_tours_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[58] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[58] . "",
        'id'       => "item_39",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_39",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_40&sc_apl_menu=form_empresas_usr_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_empresas_usr_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_empresas_usr_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[59] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[59] . "",
        'id'       => "item_40",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_40",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_41&sc_apl_menu=form_eventos_usuarios_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_usuarios_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_usuarios_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[60] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[60] . "",
        'id'       => "item_41",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_41",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_42&sc_apl_menu=grid_bloqueio_aereo_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_aereo_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_aereo_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[61] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[61] . "",
        'id'       => "item_42",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_42",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_80&sc_apl_menu=grid_bloqueio_hoteis_rsvp_1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_hoteis_rsvp_1']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_bloqueio_hoteis_rsvp_1']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[62] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[62] . "",
        'id'       => "item_80",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_80",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_43&sc_apl_menu=grid_eventos_opcionais_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_opcionais_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_opcionais_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[63] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[63] . "",
        'id'       => "item_43",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_43",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_44&sc_apl_menu=form_eventos_programa_sf&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_programa_sf']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_eventos_programa_sf']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[64] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[64] . "",
        'id'       => "item_44",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_44",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_52&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[65] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[65] . "",
        'id'       => "item_52",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_52",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_81&sc_apl_menu=grid_confirmacao_viagem_rsvp_1&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_confirmacao_viagem_rsvp_1']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_confirmacao_viagem_rsvp_1']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[66] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[66] . "",
        'id'       => "item_81",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_81",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[67] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[67] . "",
    'id'       => "item_74",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_74",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_51&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[68] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[68] . "",
        'id'       => "item_51",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_51",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[69] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[69] . "",
    'id'       => "item_31",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_31",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_46&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[70] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[70] . "",
        'id'       => "item_46",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_46",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_47&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[71] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[71] . "",
        'id'       => "item_47",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_47",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_49&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[72] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[72] . "",
        'id'       => "item_49",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_49",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_72&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[73] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[73] . "",
        'id'       => "item_72",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_72",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_76&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[74] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[74] . "",
        'id'       => "item_76",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_76",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[75] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[75] . "",
    'id'       => "item_50",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_50",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_58&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[76] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[76] . "",
        'id'       => "item_58",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_58",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_60&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[77] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[77] . "",
        'id'       => "item_60",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_60",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_62&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[78] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[78] . "",
        'id'       => "item_62",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_62",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_63&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[79] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[79] . "",
        'id'       => "item_63",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_63",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_71&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[80] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[80] . "",
        'id'       => "item_71",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_71",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_53&sc_apl_menu=grid_mailling_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_mailling_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_mailling_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[81] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[81] . "",
        'id'       => "item_53",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_53",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_73&sc_apl_menu=grid_inconsistmailling&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_inconsistmailling']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['grid_inconsistmailling']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[82] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[82] . "",
        'id'       => "item_73",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_73",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_75&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[83] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[83] . "",
        'id'       => "item_75",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_75",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[84] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[84] . "",
    'id'       => "item_111",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_111",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_117&sc_apl_menu=chart_aereos_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['chart']['active']))
    {
        $icon_aba = $arr_menuicons['chart']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['chart']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['chart']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[85] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[85] . "",
        'id'       => "item_117",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_117",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_116&sc_apl_menu=chart_aereos_rsvp_va&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp_va']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_aereos_rsvp_va']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['chart']['active']))
    {
        $icon_aba = $arr_menuicons['chart']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['chart']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['chart']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[86] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[86] . "",
        'id'       => "item_116",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_116",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_115&sc_apl_menu=chart_hospedagem_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['chart']['active']))
    {
        $icon_aba = $arr_menuicons['chart']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['chart']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['chart']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[87] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[87] . "",
        'id'       => "item_115",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_115",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_114&sc_apl_menu=chart_hospedagem_rsvp_vh&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp_vh']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_hospedagem_rsvp_vh']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['chart']['active']))
    {
        $icon_aba = $arr_menuicons['chart']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['chart']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['chart']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[88] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[88] . "",
        'id'       => "item_114",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_114",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_113&sc_apl_menu=chart_participantes_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_participantes_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_participantes_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['chart']['active']))
    {
        $icon_aba = $arr_menuicons['chart']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['chart']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['chart']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[89] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[89] . "",
        'id'       => "item_113",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_113",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_112&sc_apl_menu=chart_presencas_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['chart_presencas_rsvp']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['chart_presencas_rsvp']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['chart']['active']))
    {
        $icon_aba = $arr_menuicons['chart']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['chart']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['chart']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[90] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[90] . "",
        'id'       => "item_112",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_112",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[91] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[91] . "",
    'id'       => "item_118",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_118",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[92] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[92] . "",
    'id'       => "item_122",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_122",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_123&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[93] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[93] . "",
        'id'       => "item_123",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_123",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_124&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[94] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[94] . "",
        'id'       => "item_124",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_124",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[95] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[95] . "",
    'id'       => "item_121",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_121",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_126&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[96] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[96] . "",
        'id'       => "item_126",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_126",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_125&sc_apl_menu=control_rel_01&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['control_rel_01']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[97] . "",
        'level'    => "2",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[97] . "",
        'id'       => "item_125",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_self') . "\"",
        'sc_id'    => "item_125",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[98] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[98] . "",
    'id'       => "item_128",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_128",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[99] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[99] . "",
    'id'       => "item_129",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_129",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[100] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[100] . "",
    'id'       => "item_130",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_130",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[101] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[101] . "",
    'id'       => "item_149",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_149",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_132&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/mod-01 RSVP - inclusao de eventos.mp4&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[102] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[102] . "",
    'id'       => "item_132",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " item-target=\"" . $this->administrativo_menu_target('_blank') . "\"",
    'sc_id'    => "item_132",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_133&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/mod-02 RSVP - inclusao de eventos.mp4&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[103] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[103] . "",
    'id'       => "item_133",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " item-target=\"" . $this->administrativo_menu_target('_blank') . "\"",
    'sc_id'    => "item_133",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[104] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[104] . "",
    'id'       => "item_131",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_131",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[105] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[105] . "",
    'id'       => "item_148",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_148",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_135&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/02-Criando Eventos com ou sem vinculo com o aplicativo Be Invited.html&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[106] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[106] . "",
    'id'       => "item_135",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " item-target=\"" . $this->administrativo_menu_target('_blank') . "\"",
    'sc_id'    => "item_135",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[107] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[107] . "",
    'id'       => "item_136",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_136",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[108] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[108] . "",
    'id'       => "item_137",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_137",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[109] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[109] . "",
    'id'       => "item_138",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_138",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[110] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[110] . "",
    'id'       => "item_139",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_139",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[111] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[111] . "",
    'id'       => "item_140",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_140",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[112] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[112] . "",
    'id'       => "item_141",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_141",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[113] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[113] . "",
    'id'       => "item_142",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_142",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[114] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[114] . "",
    'id'       => "item_143",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_143",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[115] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[115] . "",
    'id'       => "item_144",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_144",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[116] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[116] . "",
    'id'       => "item_145",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_145",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[117] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[117] . "",
    'id'       => "item_146",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_146",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[118] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[118] . "",
    'id'       => "item_147",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_147",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[119] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[119] . "",
    'id'       => "item_150",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => "",
    'sc_id'    => "item_150",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_134&sc_apl_menu=https://seudominio.exemplo.com.br/nrsvp/_lib/tutoriais/visao geral.html&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$administrativo_menu_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[120] . "",
    'level'    => "2",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[120] . "",
    'id'       => "item_134",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " item-target=\"" . $this->administrativo_menu_target('_blank') . "\"",
    'sc_id'    => "item_134",
    'disabled' => $str_disabled,
    'display'     => "text_img",
    'display_position'=> "text_right",
    'icon_fa'     => "fas fa-cog",
    'icon_color'     => "",
    'icon_color_hover'     => "",
    'icon_color_disabled'     => "",
);
$str_disabled = "N";
$str_link = "administrativo_menu_form_php.php?sc_item_menu=item_69&sc_apl_menu=blank_limpaRel&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['blank_limpaRel']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['blank_limpaRel']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['blank']['active']))
    {
        $icon_aba = $arr_menuicons['blank']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['blank']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['blank']['inactive'];
    }
    $administrativo_menu_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[121] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[121] . "",
        'id'       => "item_69",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->administrativo_menu_target('_parent') . "\"",
        'sc_id'    => "item_69",
        'disabled' => $str_disabled,
        'display'     => "text_img",
        'display_position'=> "text_right",
        'icon_fa'     => "fas fa-cog",
        'icon_color'     => "",
        'icon_color_hover'     => "",
        'icon_color_disabled'     => "",
    );

if (isset($_SESSION['scriptcase']['sc_def_menu']['administrativo_menu']))
{
    $arr_menu_usu = $this->nm_arr_menu_recursiv($_SESSION['scriptcase']['sc_def_menu']['administrativo_menu']);
    $this->nm_gera_menus($str_menu_usu, $arr_menu_usu, 1, 'administrativo_menu');
    $administrativo_menu_menuData['data'] = $str_menu_usu;
}
if (is_file("administrativo_menu_help.txt"))
{
    $Arq_WebHelp = file("administrativo_menu_help.txt"); 
    if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
    {
        $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
        $Tmp = explode(";", $Arq_WebHelp[0]); 
        foreach ($Tmp as $Cada_help)
        {
            $Tmp1 = explode(":", $Cada_help); 
            if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "menu" && is_file($str_root . $path_help . $Tmp1[1]))
            {
                $str_disabled = "N";
                $str_link = "" . $path_help . $Tmp1[1] . "";
                $str_icon = "";
                $icon_aba = "";
                $icon_aba_inactive = "";
                if(empty($icon_aba) && isset($arr_menuicons['']['active']))
                {
                    $icon_aba = $arr_menuicons['']['active'];
                }
                if(empty($icon_aba_inactive) && isset($arr_menuicons['']['inactive']))
                {
                    $icon_aba_inactive = $arr_menuicons['']['inactive'];
                }
                $administrativo_menu_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => $str_link,
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->administrativo_menu_target('_blank') . "",
                    'sc_id'    => "item_Help",
                    'disabled' => $str_disabled,
                    'display'     => "text",
                    'display_position'=> "",
                    'icon_fa'     => "",
                    'icon_color'     => "",
                    'icon_color_hover'     => "",
                    'icon_color_disabled'     => "",
                );
            }
        }
    }
}

if (isset($_SESSION['scriptcase']['sc_menu_del']['administrativo_menu']) && !empty($_SESSION['scriptcase']['sc_menu_del']['administrativo_menu']))
{
    $nivel = 0;
    $exclui_menu = false;
    foreach ($administrativo_menu_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_del']['administrativo_menu']))
       {
          $nivel = $cada_menu['level'];
          $exclui_menu = true;
          unset($administrativo_menu_menuData['data'][$i_menu]);
       }
       elseif ( empty($cada_menu) || ($exclui_menu && $nivel < $cada_menu['level']))
       {
          unset($administrativo_menu_menuData['data'][$i_menu]);
       }
       else
       {
          $exclui_menu = false;
       }
    }
    $Temp_menu = array();
    foreach ($administrativo_menu_menuData['data'] as $i_menu => $cada_menu)
    {
        $Temp_menu[] = $cada_menu;
    }
    $administrativo_menu_menuData['data'] = $Temp_menu;
}

if (isset($_SESSION['scriptcase']['sc_menu_disable']['administrativo_menu']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['administrativo_menu']))
{
    $disable_menu = false;
    foreach ($administrativo_menu_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_disable']['administrativo_menu']))
       {
          $nivel = $cada_menu['level'];
          $disable_menu = true;
          $administrativo_menu_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu) && $disable_menu && $nivel < $cada_menu['level'])
       { 
          $administrativo_menu_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu))
       {
          $disable_menu = false;
       }
    }
}

/* Cabeçalho HTML */
if ($administrativo_menu_menuData['iframe'])
{
    $administrativo_menu_menuData['height'] = '100%';
    header("X-XSS-Protection: 1; mode=block");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-Content-Type-Options: nosniff");
    header("Referrer-Policy: origin-when-cross-origin");
    header("Content-Security-Policy: frame-ancestors 'self' ; img-src 'self' ; form-action 'self'  ; connect-src 'self' ; base-uri 'self' ; child-src 'self'  ; object-src 'none'");
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> style="height: 100%">
<head>
 <title>BRSVP - Menu Administrativo * Belvitur Eventos  SC 10.1 API </title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <?php
 if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
  ?>
   <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
  <?php
 }
 ?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Pragma" content="no-cache" />
 <?php 
 if(isset($str_google_fonts) && !empty($str_google_fonts)) 
 { 
     ?> 
     <link rel="stylesheet" type="text/css" href="<?php echo $str_google_fonts ?>" /> 
     <?php 
 } 
 ?> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_btngrp.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_btngrp.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_btngrp.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menutab.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menutab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_menuH.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_menuH.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $Str_btn_css ?>" /> 
 <link rel="stylesheet" href="<?php echo $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']; ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../_lib/css/_menuTheme/scriptcase_Scriptcase_GrayWhite_<?php echo ($this->menu_orientacao!='vertical')?'hor':'vert'; ?>_<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir']; ?>.css<?php if (@is_file($this->path_css . '_menuTheme/' . "scriptcase_Scriptcase_GrayWhite" . '_' . (($this->menu_orientacao!='vertical')?'hor':'vert') . '.css')) { echo '?scp=' . md5($this->path_css . '_menuTheme/' . "scriptcase_Scriptcase_GrayWhite" . '_' . (($this->menu_orientacao=='horizontal')?'hor':'vert') . '.css'); } ?>" />
<style>
   .scTabText {
   }    <?php
        if(isset($_SESSION['scriptcase']['sc_def_menu']) && !empty($_SESSION['scriptcase']['sc_def_menu']))
        {
            foreach($_SESSION['scriptcase']['sc_def_menu'] as $arr_menus)
            {
              foreach($arr_menus as $id => $arr_item)
              {
                  if(isset($arr_item['icon_color']) && !empty($arr_item['icon_color']))
                  {
                      echo "   #" . $id . " .icon_fa{ color: ". $arr_item['icon_color'] ."  !important}
";
                      if(isset($menu_parms1['icons_inherit_style']) && $menu_parms1['icons_inherit_style'] == 'S')
                      {
                          echo "   #aba_td_" . $id . " i{ color:". $arr_item['icon_color'] ."  !important}
";
                      }
                  }
                  if(isset($arr_item['icon_color_hover']) && !empty($arr_item['icon_color_hover']))
                  {
                      echo "   #" . $id . ":hover .icon_fa{ color: ". $arr_item['icon_color_hover'] ."  !important}
";
                      if(isset($menu_parms1['icons_inherit_style']) && $menu_parms1['icons_inherit_style'] == 'S')
                      {
                          echo "   #aba_td_" . $id . ":hover i{ color:". $arr_item['icon_color_hover'] ."  !important}
";
                      }
                  }
                  if(isset($arr_item['icon_color_disabled']) && !empty($arr_item['icon_color_disabled']))
                  {
                      echo "   #" . $id . ".scdisabledmain .icon_fa{ color: ". $arr_item['icon_color_disabled'] ."  !important}
";
                      echo "   #" . $id . ".scdisabledsub .icon_fa{ color: ". $arr_item['icon_color_disabled'] ."  !important}
";
                      if(isset($menu_parms1['icons_inherit_style']) && $menu_parms1['icons_inherit_style'] == 'S')
                      {
                          echo "   #aba_td_" . $id . ".scTabInactive i{ color:". $arr_item['icon_color_disabled'] ."  !important}
";
                      }
                  }
              }
            }
        }
    ?>
</style>
<script type="text/javascript">
<?php

if ($this->menu_orientacao=='horizontal')
{
 ?>
 var is_menu_vertical = false;
 <?php
}
else
{
 ?>
 var is_menu_vertical = true;
 <?php
}
?>
 function sc_session_redir(url_redir)
 {
     if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
     {
         window.parent.sc_session_redir(url_redir);
     }
     else
     {
         if (window.opener && typeof window.opener.sc_session_redir === 'function')
         {
             window.close();
             window.opener.sc_session_redir(url_redir);
         }
         else
         {
             window.location = url_redir;
         }
     }
 }
</script>
</head>
<body style="height: 100%" scroll="no" class='scMenuHPage'>
<?php

if ('' != $sOutputBuffer)
{
    echo $sOutputBuffer;
}

    $NM_scr_iframe = (isset($_POST['hid_scr_iframe'])) ? $_POST['hid_scr_iframe'] : "";   
}
else
{
    $administrativo_menu_menuData['height'] = '30px';
}

/* Arquivos JS */
?>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']; ?>/third/jquery/js/jquery.js"></script>
<script type="text/javascript" src="../_lib/lib/js/menu_structure.js"></script>
<script  type="text/javascript" src="<?php echo $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']; ?>/third/jquery_plugin/contextmenu/jquery.contextmenu.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']; ?>/third/jquery_plugin/contextmenu/contextmenu.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_contextmenu.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_contextmenu.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_contextmenu.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_contextmenu.css'); } ?>" /> 
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_sweetalert.css" />
<?php
$confirmButtonClass = '';
$cancelButtonClass  = '';
$confirmButtonText  = $this->Nm_lang['lang_btns_cfrm'];
$cancelButtonText   = $this->Nm_lang['lang_btns_cncl'];
$confirmButtonFA    = '';
$cancelButtonFA     = '';
$confirmButtonFAPos = '';
$cancelButtonFAPos  = '';
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
    $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
    $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['value']) && '' != $this->arr_buttons['bsweetalert_ok']['value']) {
    $confirmButtonText = $this->arr_buttons['bsweetalert_ok']['value'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['value']) && '' != $this->arr_buttons['bsweetalert_cancel']['value']) {
    $cancelButtonText = $this->arr_buttons['bsweetalert_cancel']['value'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
    $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
    $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
    $confirmButtonFAPos = 'text_right';
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
    $cancelButtonFAPos = 'text_right';
}
?>
<script type="text/javascript">
  var scSweetAlertConfirmButton = "<?php echo $confirmButtonClass ?>";
  var scSweetAlertCancelButton = "<?php echo $cancelButtonClass ?>";
  var scSweetAlertConfirmButtonText = "<?php echo $confirmButtonText ?>";
  var scSweetAlertCancelButtonText = "<?php echo $cancelButtonText ?>";
  var scSweetAlertConfirmButtonFA = "<?php echo $confirmButtonFA ?>";
  var scSweetAlertCancelButtonFA = "<?php echo $cancelButtonFA ?>";
  var scSweetAlertConfirmButtonFAPos = "<?php echo $confirmButtonFAPos ?>";
  var scSweetAlertCancelButtonFAPos = "<?php echo $cancelButtonFAPos ?>";
</script>
<script type="text/javascript" src="administrativo_menu_message.js"></script>
<script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
<script type="text/javascript">
$(function() {
<?php
if (isset($this->nm_mens_alert) && count($this->nm_mens_alert)) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
?>
       scJs_alert('<?php echo $mensagem ?>', <?php echo $jsonParams ?>);
<?php
       }
   }
}
?>
});
</script>
<?php
$_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Nm_lang['lang_mnth_janu'],
                                  $this->Nm_lang['lang_mnth_febr'],
                                  $this->Nm_lang['lang_mnth_marc'],
                                  $this->Nm_lang['lang_mnth_apri'],
                                  $this->Nm_lang['lang_mnth_mayy'],
                                  $this->Nm_lang['lang_mnth_june'],
                                  $this->Nm_lang['lang_mnth_july'],
                                  $this->Nm_lang['lang_mnth_augu'],
                                  $this->Nm_lang['lang_mnth_sept'],
                                  $this->Nm_lang['lang_mnth_octo'],
                                  $this->Nm_lang['lang_mnth_nove'],
                                  $this->Nm_lang['lang_mnth_dece']);
$_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Nm_lang['lang_shrt_mnth_dece']);
$_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Nm_lang['lang_days_sund'],
                                  $this->Nm_lang['lang_days_mond'],
                                  $this->Nm_lang['lang_days_tued'],
                                  $this->Nm_lang['lang_days_wend'],
                                  $this->Nm_lang['lang_days_thud'],
                                  $this->Nm_lang['lang_days_frid'],
                                  $this->Nm_lang['lang_days_satd']);
$_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Nm_lang['lang_shrt_days_sund'],
                                  $this->Nm_lang['lang_shrt_days_mond'],
                                  $this->Nm_lang['lang_shrt_days_tued'],
                                  $this->Nm_lang['lang_shrt_days_wend'],
                                  $this->Nm_lang['lang_shrt_days_thud'],
                                  $this->Nm_lang['lang_shrt_days_frid'],
                                  $this->Nm_lang['lang_shrt_days_satd']);
$Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
$Lim   = strlen($Str_date);
$Ult   = "";
$Arr_D = array();
for ($I = 0; $I < $Lim; $I++)
{
    $Char = substr($Str_date, $I, 1);
    if ($Char != $Ult)
    {
        $Arr_D[] = $Char;
    }
    $Ult = $Char;
}
$Prim = true;
$Str  = "";
foreach ($Arr_D as $Cada_d)
{
    $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
    $Str .= $Cada_d;
    $Prim = false;
}
$Str = str_replace("a", "Y", $Str);
$Str = str_replace("y", "Y", $Str);
$nm_data_fixa = date($Str); 
?>
<?php
if($this->menu_orientacao=='vertical')
{
  $qtd_col = 2;
  if(is_array($bg_line_degrade) && count($bg_line_degrade)>0)
  {
      $qtd_col = $qtd_col + count($bg_line_degrade);
  }
  $larg_table = "100%";
  $col_span   = ' colspan="'. $qtd_col .'"';
}
else
{
  $larg_table = "100%";
  $col_span   = "";
}
$strAlign = 'align=\'left\'';
?>
<?php
$str_bmenu = nmButtonOutput($this->arr_buttons, "bmenu", "showMenu();", "showMenu();", "bmenu", "", "" . $this->Nm_lang['lang_btns_menu'] . "", "position:absolute; top:0px; left:0px; z-index:102;", "absmiddle", "", "0px", $this->path_botoes, "", "" . $this->Nm_lang['lang_btns_menu_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
    $menu_mobile_hide          = $mobile_menu_mobile_hide;
    $menu_mobile_inicial_state = $mobile_menu_mobile_inicial_state;
    $menu_mobile_hide_onclick  = $mobile_menu_mobile_hide_onclick;
    $menutree_mobile_float     = $mobile_menutree_mobile_float;
    $menu_mobile_hide_icon     = $mobile_menu_mobile_hide_icon;
    $menu_mobile_hide_icon_menu_position     = $mobile_menu_mobile_hide_icon_menu_position;
}
if($menu_mobile_hide == 'S')
{
    if($menu_mobile_inicial_state =='escondido')
    {
            $str_menu_display="hide";
            $str_btn_display="show";
    }
    else
    {
        $str_menu_display="show";
        $str_btn_display="hide";
    }
    if($menu_mobile_hide_icon != 'S')
    {
        $str_btn_display="show";
    }
?>
<script>
    $( document ).ready(function() {
        $('#bmenu').<?php echo $str_btn_display; ?>();
        $('#idMenuCell').<?php echo $str_menu_display; ?>();
        $('#id_toolbar').<?php echo $str_menu_display; ?>();
        <?php
                    if($this->menu_orientacao != 'vertical')
                    {
                        if($menu_mobile_hide_icon == 'N')
                        {
                        ?>
                            $("#idDivMenu").css("padding-left", $('#bmenu').outerWidth());
                        <?php
                        }
                    }
                    else
                    {
                        if($menu_mobile_hide_icon == 'N')
                        {
                        ?>
                            $("#idMenuToolbar").css("padding-left", $('#bmenu').outerWidth());
                        <?php
                        }
                    }
                    if($menutree_mobile_float == 'S')
                    {
                    ?>
                    str_html_menu    = $('#idMenuCell').html();
                    str_html_toolbar = '';
                    if($('#idMenuToolbar').length)
                    {
                      str_html_toolbar = $('#idMenuToolbar').html();
                    }
                    $('#idMenuCell').remove();
                    $('#idMenuToolbar').remove();
                    $( 'body' ).prepend( "<div id='idMenuFLoat' style='height:0px;'><div id='idMenuCell' style='position:absolute; z-index: 101'>"+ str_html_menu + "</div><div id='id_toolbar' style='position:absolute; z-index: 100;'>" + str_html_toolbar +"</div></div>" );
                    <?php
                    if($this->menu_orientacao == 'vertical')
                    {
                        ?>
                            $("#idMenuCell").css("padding-top", $('#bmenu').outerHeight());
                            $("#idMenuCell").css("left", '0px');
                            $("#id_toolbar").css("padding-left", $('#bmenu').outerWidth());
                            $("#id_toolbar").css("display", 'flex');
                        <?php
                        if($menu_mobile_hide_icon == 'S')
                        {
                        ?>
                            $("#id_toolbar").css("padding-left", '0px');
                        <?php
                        }
                        ?>
                        if($( '#id_toolbar' ).width() < 1  || $( '#id_toolbar' ).width() > $( window ).width())
                        {
                            $('#id_toolbar').css('display', 'block');
                            $('#id_toolbar').css('padding-left', $('#idMenuCell').outerWidth());
                            <?php
                            if($menu_mobile_hide_icon == 'S')
                            {
                            ?>
                                $("#id_toolbar").css("padding-top", '0px');
                            <?php
                            }
                        ?>
                        }
                        <?php
                    }
                    else
                    {
                        ?>
                            $("#id_toolbar").css("top", $('#idMenuCell').outerHeight());
                            <?php
                            if($menu_mobile_hide_icon == 'S')
                            {
                            ?>
                                $("#id_toolbar").css("padding-left", '0px');
                            <?php
                            }
                            else{
                            ?>
                                $("#id_toolbar").css("padding-left", $('#bmenu').outerWidth());
                            <?php
                            }
                    }
                    if($menu_mobile_inicial_state =='escondido')
                    {
                        ?>
                            $("#idMenuCell").hide();
                            $("#id_toolbar").hide();
                        <?php
                    }
                }
           ?>
    });
    function showMenu()
    {
      if (!$('#idMenuCell').is(':visible')) { $('body').append('<div class="menu-outclick-overlay" style="height: 100vh; width: 100vw; position: fixed; z-index: 90; top: 0; left: 0;" ></div>');}
      $('.menu-outclick-overlay').on('click', function () {HideMenu();});
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').hide();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
            $('#id_toolbar').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
  setTimeout(function(){ scToggleOverflow(); }, 600);
      <?php
      }
      ?>
    }
    function HideMenu()
    {
      $('.menu-outclick-overlay').remove();
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').show();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
            $('#id_toolbar').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
  setTimeout(function(){ scToggleOverflow(); }, 600);
      <?php
      }
      ?>
    }
</script>
<?php
echo $str_bmenu;
}
?>
<script>
$(document).ready(function() {
});
        $( document ).ready(function() {
            $.contextMenu({
                selector:'#contrl_abas > li:not(#id_tab_init_tab)',
                leftButton: true,
                callback: function(key, options)
                {
                        switch(key)
                        {
                            case 'close':
                                contextMenuCloseTab($(this).attr('id'));
                            break;

                            case 'closeall':
                                contextMenuCloseAllTabs();
                            break;

                            case 'closeothers':
                                contextMenuCloseOthersTabs($(this).attr('id'));
                            break;

                            case 'closeright':
                                contextMenuCloseRight($(this).attr('id'));
                            break;

                            case 'closeleft':
                                contextMenuCloseLeft($(this).attr('id'));
                            break;
                            
                            case 'reload':
                                contextMenuReload($(this).attr('id'));
                            break;
                            
                            case 'openbrowser':
                                contextMenuAction('openbrowser', $(this).attr('id'));
                            break;
                            
                            case 'duplicatetab':
                                contextMenuAction('duplicatetab', $(this).attr('id'));
                            break;
                        }
                    },
                items: {                        "close": {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_close']); ?>'},
                        "closeall": {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeall']); ?>'},
                        "closeothers" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeothers']); ?>'},
                        "closeright" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeright']); ?>'},
                        "closeleft" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeleft']); ?>'},                    }
            });
            
            $.contextMenu({
                selector:'#contrl_abas > li#id_tab_init_tab',
                leftButton: true,
                callback: function(key, options)
                {
                        switch(key)
                        {

                            case 'reload':
                                contextMenuReload($(this).attr('id'));
                            break;
                            
                            case 'closeothers':
                                contextMenuCloseOthersTabs($(this).attr('id'));
                            break;

                            case 'closeright':
                                contextMenuCloseRight($(this).attr('id'));
                            break;

                        }
                    },
                items: {                        "closeothers" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeothers']); ?>'},
                        "closeright" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeright']); ?>'},
                    }
            });
        });

        function contextMenuCloseAllTabs()
        {
            $( "#contrl_abas li" ).each(function( index ) {
                contextMenuCloseTab($( this ).attr('id'));
            });
        }

        function contextMenuCloseTab(str_id)
        {
            if(str_id.indexOf('aba_td_') >= 0)
            {
                str_id = str_id.substr(7);
            }
            del_aba_td( str_id );
        }

        function contextMenuCloseRight(str_id)
        {
            bol_start_del = false;
            $( "#contrl_abas li" ).each(function( index ) {

                if(bol_start_del)
                {
                    contextMenuCloseTab($( this ).attr('id'));
                }

                if(str_id == $( this ).attr('id'))
                {
                    bol_start_del = true;
                }
            });
        }


        function contextMenuCloseLeft(str_id)
        {
            $( "#contrl_abas li" ).each(function( index ) {

                if(str_id == $( this ).attr('id'))
                {
                     return false;
                }
                else
                {
                    contextMenuCloseTab($( this ).attr('id'));
                }
            });
        }

        var duplicatetab = [];
        function contextMenuAction(option, str_id)
        {
            if (str_id.indexOf("id_tab_copy_") >= 0)
            {
                str_orig = str_id.substr(12);
                str_orig = str_orig.substr(str_orig.indexOf('_')+1);
                str_id = 'id_tab_' + str_orig;
            }
            
            var tabdiv = $('#' + str_id.replace('id_tab_', '') + '');
            switch(option)
            {
                case 'openbrowser':                    
                    window.open(tabdiv.find('iframe').attr('data-initial-src'));
                break;
                case 'duplicatetab':
                    hasItem = false;
                    contIndex = 1;
                    duplicatetab.forEach(function(element, index) {
                        if(element.str_id == str_id)
                        {
                            duplicatetab[index].cont++;
                            contIndex = duplicatetab[index].cont;
                            hasItem = true;
                        }
                    });
                    if(!hasItem)
                    {
                        duplicatetab.push({ 'str_id': str_id, cont: 1 });
                    }
                    
                    var el = $("a[tab-name='"+ str_id.replace('id_tab_', '') +"']");
                    var url = el.attr('href');
                    var tabName = 'copy_' + contIndex + '_' + str_id.replace('id_tab_', '');
                    var tabTitle = el.attr('tab-title');
                    var tabHint = el.attr('title');
                    var tabTarget = el.attr('target');
                    var tabIcon = (el.find('i.mb_icon')[0]) ? el.find('i.mb_icon')[0].outerHTML : '';

                    openInTab(url, tabName, tabTitle, tabHint, tabIcon, tabTarget);
                break;
            }
        }
        
        function contextMenuReload(str_id)
        {
            var tabdiv = $('#' + str_id.replace('id_tab_', '') + '');
            setLoadingTab($(tabdiv).attr('id'));
            tabdiv.find('iframe').attr('src', tabdiv.find('iframe').attr('data-initial-src'));
            // tabdiv.find('iframe')[0].contentWindow.location.reload();
        }

        function contextMenuCloseOthersTabs(str_id)
        {
            $( "#contrl_abas li" ).each(function( index ) {
                if(str_id != $( this ).attr('id'))
                {
                    contextMenuCloseTab($( this ).attr('id'));
                }
            });
        }

function expandMenu()
{
    $('#idMenuHeader').hide();
    $('#<?php echo ($this->menu_orientacao=='vertical')?'idMenuCell':'idMenuLine'; ?>').hide();
    $('#id_toolbar').hide();
    $('#id_expand').hide();
    $('#id_collapse').show();
}

function collapseMenu()
{
    $('#idMenuHeader').show();
    $('#<?php echo ($this->menu_orientacao=='vertical')?'idMenuCell':'idMenuLine'; ?>').show();
    $('#id_toolbar').show();
    $('#id_expand').show();
    $('#id_collapse').hide();
}
Iframe_atual = "administrativo_menu_iframe";
function writeFastMenu(arr_link)
{
  return false;
}
function clearFastMenu(arr_link)
{
  return false;
}
Tab_iframes         = new Array();
Tab_labels          = new Array();
Tab_hints           = new Array();
Tab_icons           = new Array();
Tab_icons_inactive  = new Array();
Tab_abas            = new Array();
Tab_refresh         = new Array();
Tab_icon_fa         = new Array();
Tab_icon_fa_inactive= new Array();
Tab_display         = new Array();
Tab_display_position= new Array();
Tab_links          = new Array();
var scScrollInterval = divOverflow = false;
Tab_ico_def        = new Array();
Tab_ico_ina_def    = new Array();
<?php
 foreach ($arr_menuicons as $tp => $icon)
 {
    echo "Tab_ico_def['$tp']     = '" . $icon['active'] . "';\r\n";
    echo "Tab_ico_ina_def['$tp'] = '" . $icon['inactive'] . "';\r\n";
 }
?>
Aba_atual    = "";
<?php
 $seq = 0;
echo "Tab_iframes[" . $seq . "] = \"administrativo_menu\";\r\n";
echo "Tab_labels['administrativo_menu'] = \"Eventos \";\r\n";
echo "Tab_hints['administrativo_menu'] = \"Eventos \";\r\n";
echo "Tab_abas['administrativo_menu']   = \"none\";\r\n";
echo "Tab_refresh['administrativo_menu']   = \"\";\r\n";
echo "Tab_icons['administrativo_menu'] = \"scriptcase__NM__ico__NM__sc_menu_home_e.png\";\r\n";
echo "Tab_icons_inactive['administrativo_menu'] = \"scriptcase__NM__ico__NM__sc_menu_home_d.png\";\r\n";
echo "Tab_icon_fa['administrativo_menu']   = \"\";\r\n";
echo "Tab_icon_fa_inactive['administrativo_menu']   = \"\";\r\n";
echo "Tab_display['administrativo_menu']   = \"\";\r\n";
echo "Tab_display_position['administrativo_menu']   = \"\";\r\n";
echo "Tab_links['administrativo_menu']   = \"\";\r\n";
         $seq++;
 if(isset($administrativo_menu_menuData['data']) && !empty($administrativo_menu_menuData['data']))
 {
   foreach ($administrativo_menu_menuData['data'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         if(empty($dados_menu['hint']))
         {
             $dados_menu['hint'] = $dados_menu['label'];
         }
         echo "Tab_iframes[" . $seq . "] = \"" . $dados_menu['id'] . "\";\r\n";
         echo "Tab_labels['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['label']) . "\";\r\n";
         echo "Tab_hints['" . $dados_menu['id'] . "'] = \"" . strip_tags(str_replace('"', '\"', $dados_menu['hint'])) . "\";\r\n";
         echo "Tab_abas['" . $dados_menu['id'] . "']   = \"none\";\r\n";
         echo "Tab_refresh['" . $dados_menu['id'] . "']   = \"\";\r\n";
         echo "Tab_icons['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba'] . "\";\r\n";
         echo "Tab_icons_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba_inactive'] . "\";\r\n";
         echo "Tab_icon_fa['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_fa'] . "\";\r\n";
         echo "Tab_icon_fa_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_fa'] . "\";\r\n";
         echo "Tab_display['" . $dados_menu['id'] . "'] = \"" . $dados_menu['display'] . "\";\r\n";
         echo "Tab_display_position['" . $dados_menu['id'] . "'] = \"" . $dados_menu['display_position'] . "\";\r\n";
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
         $seq++;
     }
   }
 }
 if(isset($administrativo_menu_menuData['data_user']) && !empty($administrativo_menu_menuData['data_user']))
 {
   foreach ($administrativo_menu_menuData['data_user'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         if(empty($dados_menu['hint']))
         {
             $dados_menu['hint'] = $dados_menu['label'];
         }
         echo "Tab_iframes[" . $seq . "] = \"" . $dados_menu['id'] . "\";\r\n";
         echo "Tab_labels['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['label']) . "\";\r\n";
         echo "Tab_hints['" . $dados_menu['id'] . "'] = \"" . strip_tags(str_replace('"', '\"', $dados_menu['hint'])) . "\";\r\n";
         echo "Tab_abas['" . $dados_menu['id'] . "']   = \"none\";\r\n";
         echo "Tab_refresh['" . $dados_menu['id'] . "']   = \"\";\r\n";
         echo "Tab_icons['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba'] . "\";\r\n";
         echo "Tab_icons_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba_inactive'] . "\";\r\n";
         echo "Tab_icon_fa['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_fa'] . "\";\r\n";
         echo "Tab_icon_fa_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_fa'] . "\";\r\n";
         echo "Tab_display['" . $dados_menu['id'] . "'] = \"" . $dados_menu['display'] . "\";\r\n";
         echo "Tab_display_position['" . $dados_menu['id'] . "'] = \"" . $dados_menu['display_position'] . "\";\r\n";
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
         $seq++;
     }
   }
 }
 if(isset($administrativo_menu_menuData['data_vertical']) && !empty($administrativo_menu_menuData['data_vertical']))
 {
   foreach ($administrativo_menu_menuData['data_vertical'] as $ind => $dados_menu)
   {
     if ($dados_menu['link'] != "#")
     {
         if(empty($dados_menu['hint']))
         {
             $dados_menu['hint'] = $dados_menu['label'];
         }
         echo "Tab_iframes[" . $seq . "] = \"" . $dados_menu['id'] . "\";\r\n";
         echo "Tab_labels['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['label']) . "\";\r\n";
         echo "Tab_hints['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['hint']) . "\";\r\n";
         echo "Tab_abas['" . $dados_menu['id'] . "']   = \"none\";\r\n";
         echo "Tab_refresh['" . $dados_menu['id'] . "']   = \"\";\r\n";
         echo "Tab_icons['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba'] . "\";\r\n";
         echo "Tab_icons_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba_inactive'] . "\";\r\n";
         echo "Tab_icon_fa['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_fa'] . "\";\r\n";
         echo "Tab_icon_fa_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_fa'] . "\";\r\n";
         echo "Tab_display['" . $dados_menu['id'] . "'] = \"" . $dados_menu['display'] . "\";\r\n";
         echo "Tab_display_position['" . $dados_menu['id'] . "'] = \"" . $dados_menu['display_position'] . "\";\r\n";
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
         $seq++;
     }
   }
 }
?>
Qtd_apls = <?php echo $seq ?>;
function createIframe(str_id, str_label, str_hint, str_img_on, str_img_off, str_link, tp_apl, fa_ico)
{
    if (typeof createCustomTab == 'function') {
      return createCustomTab(str_id, str_label, str_hint, str_link, tp_apl, fa_ico);
    } 
    apl_exist = false;
    Tab_icons[str_id] = str_img_on;
    Tab_icons_inactive[str_id] = str_img_off;
    Tab_refresh[str_id] = "";
    if (tp_apl == null || tp_apl == '')
    {
        tp_apl = 'others';
    }
    if (Tab_icons[str_id] == '')
    {
        Tab_icons[str_id] = Tab_ico_def[tp_apl];
    }
    if (Tab_icons_inactive[str_id] == '')
    {
        Tab_icons_inactive[str_id] = Tab_ico_ina_def[tp_apl];
    }
    for (i = 0; i < Qtd_apls; i++)
    {
        if (Tab_iframes[i] == str_id) {
            apl_exist = true;
        }
    }
    if (apl_exist)
    {
        if (Tab_abas[str_id] != 'show') {
            createAba(str_id);
        }
        var iframe = document.getElementById('iframe_' + str_id);
        iframe.src = str_link;
        mudaIframe(str_id);
        return;
    }
    var iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.id = 'iframe_' + str_id;
    iframe.name = 'administrativo_menu_' + str_id + '_iframe';
    iframe.src = str_link;
    $('#Iframe_control').append(iframe);
    $('#iframe_' + str_id).addClass( 'scMenuIframe');
    Tab_iframes[Qtd_apls] = str_id;
    Tab_labels[str_id] = str_label;
    Tab_hints[str_id] = str_hint;
    Tab_abas[str_id]   = 'none';
    Tab_links[str_id]   = '';
    Qtd_apls++;
    createAba(str_id);
    mudaIframe(str_id);
}
function createAba(str_id)
{
    var tmp = "";
    var html_icon = "";
        html_icon = "<div style='display:inline-block;'>";
        str_icon = Tab_icons[str_id];
        if(str_icon=='')
        {
            str_icon = 'scriptcase__NM__ico__NM__sc_menu_others_e.png';
        }
        if(str_icon != '')
        {
            html_icon += "<img id='aba_td_" + str_id + "_icon_active' src='<?php echo $this->path_botoes; ?>/"+ str_icon +"' align='absmiddle' class='scTabIcon'>";
        }
        str_icon = Tab_icons_inactive[str_id];
        if(str_icon=='')
        {
            str_icon = 'scriptcase__NM__ico__NM__sc_menu_others_d.png';
        }
        if(str_icon != '')
        {
            html_icon += "<img id='aba_td_" + str_id + "_icon_inactive' src='<?php echo $this->path_botoes; ?>/"+ str_icon +"' align='absmiddle' class='scTabIcon' style='display:none;'>";
        }
        html_icon += "</div>";
    if(Tab_display[ str_id ] == 'text_fontawesomeicon' || Tab_display[ str_id ] == 'only_fontawesomeicon')
    {
        html_icon = "<i id='aba_td_" + str_id + "_icon_active' class='"+ Tab_icon_fa[str_id] +"' style='vertical-align:middle;padding: 0px 4px; display:none;'></i>";
        html_icon += "<i id='aba_td_" + str_id + "_icon_inactive' class='"+ Tab_icon_fa_inactive[str_id] +"' style='vertical-align:middle;padding: 0px 4px;'></i>";
    }
    tmp  = "<li onclick=\"mudaIframe('" + str_id + "');\" id='aba_td_" + str_id + "' style='cursor:pointer' class='lslide scTabActive' title=\"" + Tab_hints[str_id] + "\">";
    if(Tab_display_position[ str_id ] != 'img_right')
    {
        tmp += html_icon;
    }
    var home_style="";
    if(str_id === 'administrativo_menu'){ home_style=";padding-left:4px;min-height:14px;"; }
    tmp += "<div id='aba_td_txt_" + str_id + "' style='display:inline-block;cursor:pointer"+home_style+"' class='scTabText' >";
    tmp += Tab_labels[str_id];
    if(Tab_display_position[ str_id ] == 'img_right')
    {
        tmp += html_icon;
    }
    tmp += "</div>";
    tmp += "<div id='aba_td_3_" + str_id + "' style='display:none;'>...</div>";
    tmp += "<div style='display:inline-block;'>";
    tmp += "    <img id='aba_td_img_" + str_id + "' src='<?php echo $this->path_botoes . "/" . $this->css_menutab_active_close_icon; ?>' onclick=\"event.stopPropagation(); del_aba_td('" + str_id + "'); \" align='absmiddle' class='scTabCloseIcon' style='cursor:pointer; z-index:9999;'>";
    tmp += "</div>";
    tmp += "</li>";
    $('#contrl_abas').append(tmp);
    Tab_abas[str_id] = 'show';
}
function mudaIframe(str_id)
{
    $('#iframe_administrativo_menu').hide();
    if (str_id == "")
    {
        $('#iframe_administrativo_menu').show();
        $('#iframe_' + Aba_atual).prop('src', '');
        $('#links_abas').hide();
        $('#id_links_abas').hide();
    }
    else
    {
        $('#aba_td_' + Aba_atual).removeClass( 'scTabActive' );
        $('#aba_td_' + Aba_atual).addClass( 'scTabInactive' );
        $('#aba_td_' + Aba_atual+'_icon_active').hide();
        $('#aba_td_' + Aba_atual+'_icon_inactive').show();
        $('#aba_td_img_' + Aba_atual).prop( 'src', '<?php echo $this->path_botoes . "/" . $this->css_menutab_inactive_close_icon; ?>' );
    }
    for (i = 0; i < Tab_iframes.length; i++) 
    {
        if (Tab_iframes[i] == str_id) 
        {
            if($('#iframe_' + Tab_iframes[i]).length < 1)
            {
                $('#Iframe_control').append('<iframe id="iframe_'+ Tab_iframes[i] +'" name="administrativo_menu_'+ Tab_iframes[i] +'_iframe" frameborder="0" class="scMenuIframe" style="display: none; width: 100%; height: 100%;" src=""></iframe>');
            }
            $('#iframe_' + Tab_iframes[i]).show();
            Aba_atual    = str_id;
            $('#aba_td_' + Aba_atual).removeClass( 'scTabInactive' );
            $('#aba_td_' + Aba_atual).addClass( 'scTabActive' );
            $('#aba_td_' + Aba_atual+'_icon_active').show();
            $('#aba_td_' + Aba_atual+'_icon_inactive').hide();
            $('#aba_td_img_' + Aba_atual).prop( 'src', '<?php echo $this->path_botoes . "/" . $this->css_menutab_active_close_icon; ?>' );
            if (Tab_iframes[i] != 'administrativo_menu') 
            {
                Iframe_atual = "administrativo_menu_" + Tab_iframes[i] + '_iframe';
            }
            $('#iframe_' + Tab_iframes[i]).contents().find('body').css('width', '');
            $('#iframe_' + Tab_iframes[i])[0].contentWindow.focus();
        } else {
            $('#iframe_' + Tab_iframes[i]).hide();
        }
    }
    if (Tab_refresh[str_id] == 'S' && typeof document.getElementById('iframe_' + str_id).contentWindow.nm_move === 'function')
    {
        Tab_refresh[str_id] = '';
        document.getElementById('iframe_' + str_id).contentWindow.nm_move('igual');
    }
}
function del_aba_td(str_id)
{
    $('#aba_td_' + str_id).remove();
    Tab_abas[str_id] = 'none';
    $('#iframe_' + str_id).prop('src', '');
    if (Aba_atual == str_id)
    {
        str_id = "";
        for (i = 0; i < Tab_iframes.length; i++) 
        {
            if (Tab_abas[Tab_iframes[i]] == 'show' && Tab_refresh[Tab_iframes[i]] == 'S')
            {
                str_id = Tab_iframes[i];
            }
        }
        if (str_id == "")
        {
            for (i = 0; i < Tab_iframes.length; i++) 
            {
                if (Tab_abas[Tab_iframes[i]] == 'show')
                {
                    str_id = Tab_iframes[i];
                }
            }
        }
        if (str_id == "" && Aba_atual != "administrativo_menu")
        {
            document.getElementById('iframe_administrativo_menu').click();
        }
        else
        {
            mudaIframe(str_id);
        }
    }
  scToggleOverflow();
}
$( document ).ready(function() { scToggleOverflow() });
function scToggleOverflow()
{
    $('.scTabScroll').hide();
    $('#div_contrl_abas').removeClass('div-overflow');
    $('#contrl_abas').width('');

    tabsWidth = 0;
    if($('.scMenuTTable').length)
    {
        tabsWidth = $('#contrl_abas').outerWidth();
        windowWidth = $('#contrl_abas').closest('.ui-layout-pane').outerWidth();
    }
    else
    {
        tabsWidth = $('#contrl_abas').outerWidth();
        windowWidth = $( window ).outerWidth();
    }

    if(windowWidth < tabsWidth)
    {
        $('.scTabScroll').show();
        $('#div_contrl_abas').addClass('div-overflow');
        $('#contrl_abas').width((windowWidth - $('#id_links_abas').outerWidth()));
    }
}

function scTabScroll(axis) {
  if (axis == 'stop') {
      clearInterval(scScrollInterval);
      return;
  }
  if (axis == 'left') {
      scScrollInterval = setInterval("$('#div_contrl_abas').scrollLeft($('#div_contrl_abas').scrollLeft() - 3)", 2);
  } else {
      scScrollInterval = setInterval("$('#div_contrl_abas').scrollLeft($('#div_contrl_abas').scrollLeft() + 3)", 2);
  }
}
        function checkSubMenuPosition(str_id)
        {
            submenu = $('#' + str_id + '.menu__link').next('ul');
            if(submenu.length)
            {
                if(submenu.offset().left + submenu.outerWidth() > $('#main_menu_table').width())
                {
                    submenu.css('margin-left', ( $('#main_menu_table').width() - submenu.offset().left - submenu.outerWidth() - 10 ));
                }
           }
        }function openMenuItem(str_id)
{
  str_target_sv = "";
  if (str_id != "iframe_administrativo_menu")
  {
      str_target_sv = str_id + "_iframe";
      str_id        = str_id.replace("administrativo_menu_","");
  }
    if($('#Iframe_control').length && $('#' + str_id).parent().length < 0)
    {
        $('#Iframe_control').append('<iframe id="iframe_btn_1" name="menu_btn_1_iframe" frameborder="0" class="scMenuIframe" style="display: none;" src=""></iframe>');
    }
  if($('#' + str_id).parent().length)
  {
      if(!$('#' + str_id).parent().hasClass('menu__item--active'))
      {
        $('#' + str_id).closest('ul').find('li').removeClass('menu__item--active');
      }
       $('#' + str_id).parent().toggleClass('menu__item--active');
  }
  str_link   = $('#' + str_id).attr('item-href');
  str_target = $('#' + str_id).attr('item-target');
  if (typeof str_link !== typeof undefined && str_link !== false) {
    str_id = str_id.replace('iframe_administrativo_menu', 'administrativo_menu');
    if (str_target == "administrativo_menu_iframe" && str_link != '' && str_link != '#' && str_link != 'javascript:')
    {
        str_target = (str_target_sv != "") ? str_target_sv : str_target;
        mudaIframe(str_id);
        $('#links_abas').css('display','');
        $('#id_links_abas').css('display','');
        if (Tab_abas[str_id] != 'show')
        {
            createAba(str_id);
      scToggleOverflow();
        }
    }
    //test link type
    if (str_link != '' && str_link != '#' && str_link != 'javascript:')
    {
        if (str_link.substring(0, 11) == 'javascript:')
        {
            eval(str_link.substring(11));
        }
        else if (str_link != '#' && str_target != '_parent')
        {
            window.open(str_link, str_target);
        }
        else if (str_link != '#' && str_target == '_parent')
        {
            document.location = str_link;
        }
        <?php
        if ($menu_mobile_hide == 'S' && $menu_mobile_hide_onclick == 'S')
        {
        ?>
            HideMenu();
        <?php
        }
        ?>
    }
    if(str_target != '_blank' && $('#iframe_administrativo_menu').length)
        $('#iframe_administrativo_menu')[0].contentWindow.focus();
  }
}
</script>
<?php
$fixMainMenuPosition = ($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])) ? '' : '; position: absolute';
?>
<table id="main_menu_table" <?php echo $strAlign; ?> style="border-collapse: collapse; border-width: 0px; height:100%; width: <?php echo $larg_table; ?><?php echo $fixMainMenuPosition; ?>" cellpadding=0 cellspacing=0>
  <tr id='idMenuHeader'>
    <td style="padding: 0px" valign="top" <?php echo $col_span; ?>>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scMenuHHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scMenuHHeaderFont" style="float: left; text-transform: uppercase;"><?php echo "BRSVP - Menu Administrativo * Belvitur Eventos  SC 10.1 API " ?></div>
    <div class="scMenuHHeaderFont" style="float: right;">   <IMG SRC="<?php echo $path_imag_cab ?>/grp__NM__img__NM__bvt-small.png" BORDER="0"/></div>
</div>    </td>
  </tr>
<?php echo ($this->menu_orientacao=='vertical')?$this->nm_show_toolbarmenu($col_span, $saida_apl, $administrativo_menu_menuData, $path_imag_cab):''; ?>  <tr class="scMenuHTableCssAlt" id='idMenuLine'>
  <?php
  if($this->menu_orientacao != 'vertical')
  {
    ?>
      <td <?php echo $strAlign; ?> valign="top" style="width:100%; height:30;padding: 0px;" id='idMenuCell'>
    <?php
  }
  else
  {
    ?>
      <td <?php echo $strAlign; ?> valign="top" style="vertical-align:top;" id='idMenuCell'>
    <?php
  }
  ?>
<div id="scScrollFix" style="height: 1px"></div>
<script type="text/javascript">
function fnScrollFix() {
 if($('#css3menu1 li').length > 0)
 {
     var txt = document.getElementById("scScrollFix").innerHTML;
     if ("&nbsp;" == txt) { txt = "&nbsp;&nbsp;"; } else { txt = "&nbsp;"; }
     document.getElementById("scScrollFix").innerHTML = txt;
 }
 setTimeout("fnScrollFix()", 1000);
}
setTimeout("fnScrollFix()", 1000);
</script>
<div id="idDivMenu">
<?php
  if($this->menu_orientacao != 'horizontal')    
  {    
    ?>    
<table style='width:100%' cellspacing='0' cellpadding='0'><tr>
    <?php    
  }    
  else    
  {    
    ?>    
<table style='<?php echo ($menutree_mobile_float == 'S' && ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))?'':'width:100%'; ?>' cellspacing='0' cellpadding='0'><tr>
    <?php    
  }    
echo $this->administrativo_menu_escreveMenu($administrativo_menu_menuData['data'], $path_imag_cab, $strAlign);
?></tr></table>
</div>
<?php
/* Controle de Iframe */
if ($administrativo_menu_menuData['iframe'])
{
?>
    </td>
<?php
if($this->menu_orientacao != 'vertical')
{
?>
  </tr>
<?php echo $this->nm_show_toolbarmenu('', $saida_apl, $administrativo_menu_menuData, $path_imag_cab); ?><?php echo $this->nm_gera_degrade(1, $bg_line_degrade, $path_imag_cab); ?>  <tr>
        <td id="links_abas" style="display: none;">
          <script>     function isMobile() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    }
    $(document).ready(function () {
        if (!$('#idMenuHeader').length && $('#idMenuFLoat').length) {
            $('#id_links_abas').css('padding-top', $('#bmenu').outerHeight() + 'px');
        }
    })</script>
          <div id="id_links_abas" style="display: none; " class='scTabLine'>
            <div class='scTabScroll left' style='float:left;display:none;' onmousedown='scTabScroll("left");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
            <div class='scTabScroll right' style='float:right;display:none;'onmousedown='scTabScroll("right");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
            <div id='div_contrl_abas' class='scTabCtrl' style='overflow:hidden;white-space: nowrap;'>
              <ul id='contrl_abas' style='margin:0px; padding:0px; display: inline-block;'></ul>
            </div>
          </div>
        </td>
        </tr><tr>
<?php
}
else
{
    echo $this->nm_gera_degrade(2, $bg_line_degrade, $path_imag_cab);
}
?>
<?php
if($this->menu_orientacao != 'vertical')
{
?>
    <td id="Iframe_control_td" style="border-width: 1px; height: 100%; padding: 0px;vertical-align:top;text-align:center;">
<?php
}
else
{
?>
    <td id='id_iframe_td' style="border-width: 1px; width: 100%; height: 100%; padding: 0px">
      <table cellspacing=0 cellpadding=0 width='100%' height='100%'>
        <tr>
        <td id="links_abas" style="display: none;">
          <script>     function isMobile() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    }
    $(document).ready(function () {
        if (!$('#idMenuHeader').length && $('#idMenuFLoat').length) {
            $('#id_links_abas').css('padding-top', $('#bmenu').outerHeight() + 'px');
        }
    })</script>
          <div id="id_links_abas" style="display: none; " class='scTabLine'>
            <div class='scTabScroll left' style='float:left;display:none;' onmousedown='scTabScroll("left");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
            <div class='scTabScroll right' style='float:right;display:none;'onmousedown='scTabScroll("right");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
            <div id='div_contrl_abas' class='scTabCtrl' style='overflow:hidden;white-space: nowrap;'>
              <ul id='contrl_abas' style='margin:0px; padding:0px; display: inline-block;'></ul>
            </div>
          </div>
        </td>
        </tr><tr>
        <td width='100%' height='100%' style='vertical-align:top;text-align:center;'>
<?php
}
?>
    <div id="Iframe_control" style='width:100%; height:100%; margin:0px; padding:0px;'>
<?php
$link_default = "";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp']) && $_SESSION['scriptcase']['sc_apl_seg']['grid_eventos_rsvp'] == "on") 
{ 
    $SCR  = "";
    $link_default = " onclick=\"openMenuItem('iframe_administrativo_menu');\" item-href=\"administrativo_menu_form_php.php?sc_item_menu=administrativo_menu&sc_apl_menu=grid_eventos_rsvp&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . "\"  item-target=\"administrativo_menu_iframe\"";
} 
else
{ 
    $SCR  = ($NM_scr_iframe != "" ? $NM_scr_iframe : "administrativo_menu_pag_ini.php");
} 
?>
      <iframe id="iframe_administrativo_menu" name="administrativo_menu_iframe" frameborder="0" class="scMenuIframe" style="width: 100%; height: 100%;"  src="<?php echo $SCR; ?>" <?php echo $link_default ?>></iframe>
<?php
}
?></div></td>
  </tr>
<?php
  if($this->menu_orientacao=='vertical')
  {
  ?>
</table>
</td>
</tr>
  <?php
  }
?>
  <tr>
    <td style="padding: 0px" <?php if($this->menu_orientacao == 'vertical'){ echo $col_span; } ?>>
<style>
#rod_col1 { margin:0px; padding: 3px 0 0 5px; float:left; overflow:hidden;}
#rod_col2 { margin:0px; padding: 3px 5px 0 0; float:right; overflow:hidden; text-align:right;}

</style>

<table style="width: 100%; height:20px;" cellpadding="0px" cellspacing="0px" class="scMenuHFooter">
    <tr>
        <td>
            <span class="scMenuHFooterFont" id="rod_col1"><?php echo "$rodape" ?></span>
        </td>
        <td>
            <span class="scMenuHFooterFont" id="rod_col2"></span>
        </td>
    </tr>
</table>    </td>
  </tr>
</table>
</body>
</html>
<?php

if (isset($link_default) && !empty($link_default))
{
    echo "<script>";
    echo "   document.getElementById('iframe_administrativo_menu').click()";
    echo "</script>";
}

}

/* Controle de Target */
function administrativo_menu_escreveMenu($arr_menu, $path_imag_cab = '', $strAlign = '')
{
    global $nm_data_fixa;
    $last      = '';
    $itemClass = ' topfirst';
    $subSize   = 2;
    $subCount  = array();
    $tabSpace  = 1;
    $intMult   = 2;
    $aMenuItemList = array();
    foreach ($arr_menu as $ind => $resto)
    {
        $aMenuItemList[] = $resto;
    }
?>
<td <?php echo $strAlign; ?>>
  <div class='mainmenu menu--horizontal'>
      <div class='menu__toggle'>
          <span></span>
          <span></span>
          <span></span>
      </div>
      <div class='menu__container '>
        <ul id="css3menu1" class="topmenu menu__list" style="<?php echo ($this->menu_orientacao=='vertical')?'width:100%;':''; ?>" >
        <?php
            for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
                if (0 == $aMenuItemList[$i]['level']) {
                    $last = $aMenuItemList[$i]['id'];
                }
            }
            for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
                if ($last == $aMenuItemList[$i]['id']) {
                    $itemClass = ' toplast';
                }
                $htmlClass = '';
                $hasChildrens = false;
                if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
                    $hasChildrens = true;
                }
                if (0 == $aMenuItemList[$i]['level']) {
                    $htmlClass = 'topmenu' . $itemClass;
                    if ($hasChildrens) {
                        $htmlClass .= ' toproot';
                    }
                }
                else
                {
                    $htmlClass .= ' menu__item--withsubmenu';
                }
                ?>
                <li class='menu__item <?php echo $htmlClass; ?>'>
                <?php
                if ('' != $aMenuItemList[$i]['icon'] && file_exists($this->path_imag_apl . "/" . $aMenuItemList[$i]['icon'])) {
                    $iconHtml = '../_lib/img/' . $aMenuItemList[$i]['icon'];
                }
                else {
                    $iconHtml = '';
                }
                $sDisabledClass = '';
                if ('Y' == $aMenuItemList[$i]['disabled']) {
                    $aMenuItemList[$i]['link']   = '#';
                    $aMenuItemList[$i]['target'] = '';
                    $sDisabledClass               = 0 == $aMenuItemList[$i]['level'] ? ' scdisabledmain' : ' scdisabledsub';
                }
                if (empty($aMenuItemList[$i]['link'])) {
                    $aMenuItemList[$i]['link']   = '#';
                }
                $str_item = "";
                if ($hasChildrens) {
                    $str_item .= "<span>";
                }
                if($aMenuItemList[$i]['display'] == 'only_img' && $iconHtml != '')
                {
                    $str_item .= '<img src=' . $iconHtml . ' border="0" />';
                }
                elseif($aMenuItemList[$i]['display'] == 'text_img' || empty($aMenuItemList[$i]['display']))
                {
                    $str_image = '';
                    $str_image_right = '';
                    if($iconHtml != '')
                    {
                        $str_image = '<img src="' . $iconHtml . '" border="0" />';
                        $str_image_right = '<img src="' . $iconHtml . '" border="0" style="margin-left: 10px; margin-right: 0px;" />';
                    }
                    if($aMenuItemList[$i]['display_position'] != 'img_right')
                    {
                        $str_item .= $str_image . $aMenuItemList[$i]['label'];
                    }
                    else
                    {
                        $str_item .= $aMenuItemList[$i]['label'] . $str_image_right;
                    }
                }
                elseif($aMenuItemList[$i]['display'] == 'only_fontawesomeicon')
                {
                    $str_item .= "<i class='icon_fa menu__icon ". $aMenuItemList[$i]['icon_fa'] ."'></i>";
                }
                elseif($aMenuItemList[$i]['display'] == 'text_fontawesomeicon')
                {
                    if($aMenuItemList[$i]['display_position'] != 'img_right')
                    {
                        $str_item .= "<i class='icon_fa ". $aMenuItemList[$i]['icon_fa'] ."'></i> ". $aMenuItemList[$i]['label'] ."";
                    }
                    else
                    {
                        $str_item .= $aMenuItemList[$i]['label'] ." <i class='icon_fa ". $aMenuItemList[$i]['icon_fa'] ."'></i>";
                    }
                }
                else
                {
                    $str_item .= $aMenuItemList[$i]['label'];
                }
                if ($hasChildrens) {
                    $str_item .= "</span>";
                }
                ?>
                    <a href="javascript:" <?php if ($hasChildrens){ ?>onmouseover="checkSubMenuPosition('<?php echo $aMenuItemList[$i]['id']; ?>');" <?php } ?> onclick="openMenuItem('administrativo_menu_<?php echo $aMenuItemList[$i]['id']; ?>');" item-href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>" <?php echo $aMenuItemList[$i]['target']; ?> class='menu__link <?php echo $sDisabledClass; ?>'><?php echo $str_item; ?></a>
                <?php
                if ($hasChildrens) {
                ?>
                    <ul class='menu__submenu' style=''>
                    <?php
                }
                else {
                ?>
                <?php
                }
                if (($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == $aMenuItemList[$i + 1]['level']) || 
                    ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) ||
                    (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) ||
                    (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == 0)) {
                    ?>
                    <?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
                    <?php
                    if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                        if (!isset($subCount[ $aMenuItemList[$i]['level'] ])) {
                            $subCount[ $aMenuItemList[$i]['level'] ] = 0;
                        }
                        $subCount[ $aMenuItemList[$i]['level'] ]++;
                    }
                    if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) {
                        for ($j = 0; $j < $aMenuItemList[$i]['level'] - $aMenuItemList[$i + 1]['level']; $j++) {
                            unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                            ?>
                            </ul>
                            </li>
                            <?php
                        }
                    }
                    elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) {
                        for ($j = 0; $j < $aMenuItemList[$i]['level']; $j++) {
                            unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                            ?>
                            </ul>
                            </li>
                            <?php
                        }
                    }
                    if ($subSize == $subCount[ $aMenuItemList[$i]['level'] ]) {
                        $subCount[ $aMenuItemList[$i]['level'] ] = 0;
                    }
                }
                $itemClass = '';
            }
        ?>
        </ul>
      </div>
  </div>
</td>
<?php
}
function administrativo_menu_target($str_target)
{
    global $administrativo_menu_menuData;
    if ('_blank' == $str_target)
    {
        return '_blank';
    }
    elseif ('_parent' == $str_target)
    {
        return '_parent';
    }
    elseif ($administrativo_menu_menuData['iframe'])
    {
        return 'administrativo_menu_iframe';
    }
    else
    {
        return $str_target;
    }
}

function nm_show_toolbarmenu($col_span, $saida_apl, $administrativo_menu_menuData, $path_imag_cab)
{
    if(!empty($this->mobile_menu_toolbar) && ($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])))
    {
        return;
    }
}

   function nm_prot_aspas($str_item)
   {
       return str_replace('"', '\"', $str_item);
   }

   function nm_gera_menus(&$str_line_ret, $arr_menu_usu, $int_level, $nome_aplicacao)
   {
       global $administrativo_menu_menuData; 
       foreach ($arr_menu_usu as $arr_item)
       {
           $str_line   = array();
           $str_line['label']    = $this->nm_prot_aspas($arr_item['label']);
           $str_line['level']    = $int_level - 1;
           $str_line['link']     = "";
           $nome_apl = $arr_item['link'];
           $pos = strrpos($nome_apl, "/");
           if ($pos !== false)
           {
               $nome_apl = substr($nome_apl, $pos + 1);
           }
           if ('' != $arr_item['link'])
           {
               if ($arr_item['target'] == '_parent')
               {
                    $str_line['link'] = "administrativo_menu_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . ""; 
               }
               else
               {
                    $str_line['link'] = "administrativo_menu_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($administrativo_menu_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_usa_grupo'] . ""; 
               }
           }
           elseif ($arr_item['target'] == '_parent')
           {
           }
           $str_line['hint']     = ('' != $arr_item['hint']) ? $this->nm_prot_aspas($arr_item['hint']) : '';
           $str_line['id']       = $arr_item['id'];
           $str_line['icon']     = ('' != $arr_item['icon_on']) ? $arr_item['icon_on'] : '';
           $str_line['icon_aba'] = (isset($arr_item['icon_aba']) && '' != $arr_item['icon_aba']) ? $arr_item['icon_aba'] : '';
           $str_line['icon_aba_inactive'] = (isset($arr_item['icon_aba_inactive']) && '' != $arr_item['icon_aba_inactive']) ? $arr_item['icon_aba_inactive'] : '';
           $str_line['display'] = (isset($arr_item['display'])) ? $arr_item['display'] : 'text_img';
           $str_line['display_position'] = (isset($arr_item['display_position'])) ? $arr_item['display_position'] : 'text_right';
           $str_line['icon_fa'] = (isset($arr_item['icon_fa'])) ? $arr_item['icon_fa'] : '';
           $str_line['icon_color'] = (isset($arr_item['icon_color'])) ? $arr_item['icon_color'] : '';
           $str_line['icon_color_hover'] = (isset($arr_item['icon_color_hover'])) ? $arr_item['icon_color_hover'] : '';
           $str_line['icon_color_disabled'] = (isset($arr_item['icon_color_disabled'])) ? $arr_item['icon_color_disabled'] : '';
           if ('' == $arr_item['link'] && $arr_item['target'] == '_parent')
           {
               $str_line['target'] = '_parent';
           }
           else
           {
                $str_line['target'] = ('' != $arr_item['target'] && '' != $arr_item['link']) ?  $this->administrativo_menu_target( $arr_item['target']) : "_self"; 
           }
           $str_line['target']   = ' item-target="' . $str_line['target']  . '" ';
           $str_line['sc_id']    = $arr_item['id'];
           $str_line['disabled'] = "N";
           $str_line_ret[] = $str_line;
           if (!empty($arr_item['menu_itens']))
           {
               $this->nm_gera_menus($str_line_ret, $arr_item['menu_itens'], $int_level + 1, $nome_aplicacao);
           }
       }
   }

   function nm_arr_menu_recursiv($arr, $id_pai = '')
   {
         $arr_return = array();
         foreach ($arr as $id_menu => $arr_menu)
         {
             if ($id_pai == $arr_menu['pai']) 
             {
                 $arr_return[] = array('label'      => $arr_menu['label'],
                                        'link'       => $arr_menu['link'],
                                        'target'     => $arr_menu['target'],
                                        'icon_on'    => $arr_menu['icon'],
                                        'icon_aba'   => $arr_menu['icon_aba'],
                                        'icon_aba_inactive'   => $arr_menu['icon_aba_inactive'],
                                        'hint'       => $arr_menu['hint'],
                                        'id'         => $id_menu,
                                        'menu_itens' => $this->nm_arr_menu_recursiv($arr, $id_menu),
                                        'display'      => $arr_menu['display'],
                                        'display_position' => $arr_menu['display_position'],
                                        'icon_fa'      => $arr_menu['icon_fa'],
                                        'icon_color'      => $arr_menu['icon_color'],
                                        'icon_color_hover'      => $arr_menu['icon_color_hover'],
                                        'icon_color_disabled'      => $arr_menu['icon_color_disabled'],
                                        );
             }
         }
         return $arr_return;
   }
   //1 horizontal
   //2 vertical
   function nm_gera_degrade($menu_opc, $bg_line_degrade, $path_imag_cab)
   {
       $str_retorno = "";
       //have bg color degrade
       if(!empty($bg_line_degrade) && count($bg_line_degrade)>0)
       {
           if($menu_opc == 1)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<tr style=\"height:1px; padding: 0px;\">\r\n";
                       $str_retorno .= "  <td style=\"height:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\"><img src='". $path_imag_cab ."/transparent.png' border=\"0\" style=\"height:1px;\"></td>\r\n";
                       $str_retorno .= "</tr>\r\n";
                   }
               }
           }
           elseif($menu_opc == 2)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<td style=\"width:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\">\r\n";
                       $str_retorno .= "<img src='" . $path_imag_cab . "/transparent.png' border=\"0\" style=\"width:1px;\">\r\n";
                       $str_retorno .= "</td>\r\n";
                   }
               }
           }
       }
       return $str_retorno;
   }
   function Gera_sc_init($apl_menu)
   {
        $_SESSION['scriptcase']['administrativo_menu']['sc_init'][$apl_menu] = rand(2, 10000);
        $_SESSION['sc_session'][$_SESSION['scriptcase']['administrativo_menu']['sc_init'][$apl_menu]] = array();
        return  $_SESSION['scriptcase']['administrativo_menu']['sc_init'][$apl_menu];
   }

function BloqMouse()
{ global $administrativo_menu_menuData;
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
  





$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
}


function inactive()
{ global $administrativo_menu_menuData;
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
  

date_default_timezone_set('America/Sao_Paulo');


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
	.center {
	text-align: center;  
	color: blue;
}
</style>
</head>
<body>
	<div class="center">
		Sua Sessão Expira em <span id="timer">35:00<span> minutos!	
   	</div>
   	<script>
   	window.onload = function(){		
	    var hou = 34;
    	var sec = 60;
    	setInterval(function(){
    	document.getElementById("timer").innerHTML = hou +" : " + sec ;
    	sec--;
    	if(sec == 00){
			hou--;
	    	sec = 60;
    		if (hou == 0) {		
				window.location.href = "https://seudominio.exemplo.com.br/nrsvp/nlogin/";
			}	
     	} else {
			document.addEventListener("mousemove", function(){  
			    hou = 34;
    			sec = 60;								
			});	
			document.addEventListener("click", function(){  
			    hou = 34;
    			sec = 60;								                
			});	
		}	
     },500);	
    }   	
    </script>
</body>
</html>
<?php 




$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
}


function CheckLog($chave) { global $administrativo_menu_menuData;
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$ret = 'ok';
		$tipo = strlen($chave);
		if ($tipo >= 11) {
			$sql = "
				SELECT
					cod_usuario
				FROM
					rsvpses_log
				WHERE
					cod_usuario = ".$this->Db->qstr($chave)."
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
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		} else {	
			$sql = "
				SELECT
					id_usuario
				FROM
					rsvpses_log
				WHERE
					id_usuario = ".$this->Db->qstr($chave)."
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
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		}	
		return $ret;
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) { global $administrativo_menu_menuData;
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
}


function usulog($pusuario) { global $administrativo_menu_menuData;
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
}


function usulog2($cpf) { global $administrativo_menu_menuData;
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'on';
  
	date_default_timezone_set('America/Sao_Paulo');
	$sqlusok = "
		SELECT
			usuario_id,
			usuario_cpf
		FROM
			usuarios_rsvp
		WHERE
			usuario_cpf = ".$this->Db->qstr($cpf)."		
		ORDER BY
			usuario_cpf		
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
		$ret = $this->rs[0][1];
$_SESSION['scriptcase']['administrativo_menu']['contr_erro'] = 'off';
}

   function getMenuArrItemLink($apl_menu, $str_id)
   {
       foreach($apl_menu as $id_item => $arr_item)
       {
           if($arr_item['id'] == $str_id)
           {
               return $arr_item;
           }
           elseif(isset($arr_item['itens']) && !empty($arr_item['itens']))
           {
               $_arr_item = $this->getMenuArrItemLink($arr_item['itens'], $str_id);
               if(isset($_arr_item) && !empty($_arr_item))
               {
                   return $_arr_item;
               }
           }
       }
   }   function regionalDefault()
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
       $_SESSION['scriptcase']['reg_conf']['html_dir_only'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
   }

}
if (isset($_POST['nmgp_start'])) {$nmgp_start = $_POST['nmgp_start'];} 
if (isset($_GET['nmgp_start']))  {$nmgp_start = $_GET['nmgp_start'];} 
$Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
$_SESSION['scriptcase']['sem_session'] = false;
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
    elseif (is_file($root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt")) {
        $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['administrativo_menu']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt"));
    }
    if (isset($apl_def)) {
        if ($apl_def[0] != "administrativo_menu") {
            $_SESSION['scriptcase']['sem_session'] = true;
            if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                $_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir'] = $apl_def[0];
            }
            else {
                $_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
            }
            $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
            $_SESSION['scriptcase']['administrativo_menu']['session_timeout']['redir_tp'] = $Redir_tp;
        }
        if (isset($_COOKIE['sc_actual_lang_NRSVP115_10_AWS_APP'])) {
            $_SESSION['scriptcase']['administrativo_menu']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_NRSVP115_10_AWS_APP'];
        }
    }
}
if ((isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang") || (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "force_lang"))
{
    if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang")
    {
        $nmgp_opcao  = $_POST['nmgp_opcao'];
        $nmgp_idioma = $_POST['nmgp_idioma'];
    }
    else
    {
        $nmgp_opcao  = $_GET['nmgp_opcao'];
        $nmgp_idioma = $_GET['nmgp_idioma'];
    }
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
$contr_administrativo_menu = new administrativo_menu_class;
$contr_administrativo_menu->administrativo_menu_menu();

?>
