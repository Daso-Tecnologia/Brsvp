<?php
   include_once('grid_confirmacao_viagem_rsvp_session.php');
   session_start();
   $_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['glo_nm_path_imag_temp']  = "";
   //check tmp
   if(empty($_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['glo_nm_path_imag_temp']))
   {
       $str_path_apl_url = $_SERVER['PHP_SELF'];
       $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
       /*check tmp*/$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
   }
   if (!isset($_SESSION['sc_session']))
   {
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
       $str_path_web    = $_SERVER['PHP_SELF'];
       $str_path_web    = str_replace("\\", '/', $str_path_web);
       $str_path_web    = str_replace('//', '/', $str_path_web);
       $root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
       if (is_file($root . $_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt"))
       {
?>
           <script language="javascript">
            parent.nm_move();
           </script>
<?php
           exit;
       }
       else {
           exit;
       }
   }
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   $Ord_Cmp = new grid_confirmacao_viagem_rsvp_Ord_cmp(); 
   $Ord_Cmp->Ord_cmp_init();
   
class grid_confirmacao_viagem_rsvp_Ord_cmp
{
  var $Nm_lang;
  var $restore;
  var $Arr_result;
  var $arr_buttons;
function Ord_cmp_init()
{
  global $sc_init, $path_img, $path_btn, $use_alias, $tab_ger_campos, $tab_def_campos, $tab_def_seq, $tab_labels, $embbed, $tbar_pos, $_POST, $_GET;
   if (isset($_POST['script_case_init']))
   {
       $sc_init    = filter_input(INPUT_POST, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
       $path_img   = (isset($_POST['path_img'])) ? strip_tags($_POST['path_img']) : "";
       $path_btn   = (isset($_POST['path_btn'])) ? strip_tags($_POST['path_btn']) : "";
       $use_alias  = (isset($_POST['use_alias'])) ? strip_tags($_POST['use_alias']) : "S";
       $fsel_ok    = (isset($_POST['fsel_ok'])) ? strip_tags($_POST['fsel_ok']) : "";
       $campos_sel = (isset($_POST['campos_sel'])) ? strip_tags($_POST['campos_sel']) : "";
       $sel_regra  = (isset($_POST['sel_regra'])) ? strip_tags($_POST['sel_regra']) : "";
       $embbed     = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $tbar_pos   = filter_input(INPUT_POST, 'toolbar_pos', FILTER_SANITIZE_SPECIAL_CHARS);
   }
   elseif (isset($_GET['script_case_init']))
   {
       $sc_init    = filter_input(INPUT_GET, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
       $path_img   = (isset($_GET['path_img'])) ? strip_tags($_GET['path_img']) : "";
       $path_btn   = (isset($_GET['path_btn'])) ? strip_tags($_GET['path_btn']) : "";
       $use_alias  = (isset($_GET['use_alias'])) ? strip_tags($_GET['use_alias']) : "S";
       $fsel_ok    = (isset($_GET['fsel_ok'])) ? strip_tags($_GET['fsel_ok']) : "";
       $campos_sel = (isset($_GET['campos_sel'])) ? strip_tags($_GET['campos_sel']) : "";
       $sel_regra  = (isset($_GET['sel_regra'])) ? strip_tags($_GET['sel_regra']) : "";
       $embbed     = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $tbar_pos   = filter_input(INPUT_GET, 'toolbar_pos', FILTER_SANITIZE_SPECIAL_CHARS);
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "pt_br";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select_orig']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select_orig'] = array();
   }
   $this->restore = isset($_POST['restore']) ? true : false;
   if ($this->restore && !class_exists('Services_JSON')) {
       include_once("grid_confirmacao_viagem_rsvp_json.php");
   }
   $this->Arr_result = array();
   
   $tab_ger_campos = array();
   $tab_def_campos = array();
   $tab_labels     = array();
   $tab_ger_campos['logo_bvt'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['logo_bvt'] = "logo_bvt";
   }
   else
   {
       $tab_def_campos['logo_bvt'] = "";
   }
   $tab_labels["logo_bvt"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_bvt"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_bvt"] : "";
   $tab_ger_campos['teste'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['teste'] = "teste";
   }
   else
   {
       $tab_def_campos['teste'] = "";
   }
   $tab_labels["teste"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["teste"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["teste"] : "";
   $tab_ger_campos['simples_mensagem'] = "on";
   $tab_def_campos['simples_mensagem'] = "simples_mensagem";
   $tab_labels["simples_mensagem"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["simples_mensagem"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["simples_mensagem"] : "";
   $tab_ger_campos['logo_aereo'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['logo_aereo'] = "logo_aereo";
   }
   else
   {
       $tab_def_campos['logo_aereo'] = "";
   }
   $tab_labels["logo_aereo"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_aereo"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_aereo"] : "";
   $tab_ger_campos['voo_origem_ida_01'] = "on";
   $tab_def_campos['voo_origem_ida_01'] = "voo_origem_ida_01";
   $tab_labels["voo_origem_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_01"] : "Origem";
   $tab_ger_campos['voo_saida_origem_ida_01'] = "on";
   $tab_def_campos['voo_saida_origem_ida_01'] = "voo_saida_origem_ida_01";
   $tab_labels["voo_saida_origem_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_01"] : "Saída";
   $tab_ger_campos['voo_destino_ida_01'] = "on";
   $tab_def_campos['voo_destino_ida_01'] = "voo_destino_ida_01";
   $tab_labels["voo_destino_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_01"] : "Destino";
   $tab_ger_campos['voo_chega_destino_ida_01'] = "on";
   $tab_def_campos['voo_chega_destino_ida_01'] = "voo_chega_destino_ida_01";
   $tab_labels["voo_chega_destino_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_01"] : "Chegada";
   $tab_ger_campos['voo_cia_ida_01'] = "on";
   $tab_def_campos['voo_cia_ida_01'] = "voo_cia_ida_01";
   $tab_labels["voo_cia_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_01"] : "Cia.";
   $tab_ger_campos['voo_numvoo_ida_01'] = "on";
   $tab_def_campos['voo_numvoo_ida_01'] = "voo_numvoo_ida_01";
   $tab_labels["voo_numvoo_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_01"] : "Num. Voo";
   $tab_ger_campos['voo_localizador_ida_01'] = "on";
   $tab_def_campos['voo_localizador_ida_01'] = "voo_localizador_ida_01";
   $tab_labels["voo_localizador_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_01"] : "Localizador";
   $tab_ger_campos['voo_etkt_ida_01'] = "on";
   $tab_def_campos['voo_etkt_ida_01'] = "voo_etkt_ida_01";
   $tab_labels["voo_etkt_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_01"] : "E-ticket";
   $tab_ger_campos['voo_assento_ida_01'] = "on";
   $tab_def_campos['voo_assento_ida_01'] = "voo_assento_ida_01";
   $tab_labels["voo_assento_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_01"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_ida_01'] = "on";
   $tab_def_campos['voo_comprado_bvt_ida_01'] = "voo_comprado_bvt_ida_01";
   $tab_labels["voo_comprado_bvt_ida_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_01"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_origem_ida_02'] = "on";
   $tab_def_campos['voo_origem_ida_02'] = "voo_origem_ida_02";
   $tab_labels["voo_origem_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_02"] : "Origem";
   $tab_ger_campos['voo_saida_origem_ida_02'] = "on";
   $tab_def_campos['voo_saida_origem_ida_02'] = "voo_saida_origem_ida_02";
   $tab_labels["voo_saida_origem_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_02"] : "Saída";
   $tab_ger_campos['voo_destino_ida_02'] = "on";
   $tab_def_campos['voo_destino_ida_02'] = "voo_destino_ida_02";
   $tab_labels["voo_destino_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_02"] : "Destino";
   $tab_ger_campos['voo_chega_destino_ida_02'] = "on";
   $tab_def_campos['voo_chega_destino_ida_02'] = "voo_chega_destino_ida_02";
   $tab_labels["voo_chega_destino_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_02"] : "Chegada";
   $tab_ger_campos['voo_cia_ida_02'] = "on";
   $tab_def_campos['voo_cia_ida_02'] = "voo_cia_ida_02";
   $tab_labels["voo_cia_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_02"] : "Cia.";
   $tab_ger_campos['voo_numvoo_ida_02'] = "on";
   $tab_def_campos['voo_numvoo_ida_02'] = "voo_numvoo_ida_02";
   $tab_labels["voo_numvoo_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_02"] : "Num. Voo";
   $tab_ger_campos['voo_localizador_ida_02'] = "on";
   $tab_def_campos['voo_localizador_ida_02'] = "voo_localizador_ida_02";
   $tab_labels["voo_localizador_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_02"] : "Localizador";
   $tab_ger_campos['voo_etkt_ida_02'] = "on";
   $tab_def_campos['voo_etkt_ida_02'] = "voo_etkt_ida_02";
   $tab_labels["voo_etkt_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_02"] : "E-ticket";
   $tab_ger_campos['voo_assento_ida_02'] = "on";
   $tab_def_campos['voo_assento_ida_02'] = "voo_assento_ida_02";
   $tab_labels["voo_assento_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_02"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_ida_02'] = "on";
   $tab_def_campos['voo_comprado_bvt_ida_02'] = "voo_comprado_bvt_ida_02";
   $tab_labels["voo_comprado_bvt_ida_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_02"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_origem_ida_03'] = "on";
   $tab_def_campos['voo_origem_ida_03'] = "voo_origem_ida_03";
   $tab_labels["voo_origem_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_03"] : "Origem";
   $tab_ger_campos['voo_saida_origem_ida_03'] = "on";
   $tab_def_campos['voo_saida_origem_ida_03'] = "voo_saida_origem_ida_03";
   $tab_labels["voo_saida_origem_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_03"] : "Saída";
   $tab_ger_campos['voo_destino_ida_03'] = "on";
   $tab_def_campos['voo_destino_ida_03'] = "voo_destino_ida_03";
   $tab_labels["voo_destino_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_03"] : "Destino";
   $tab_ger_campos['voo_chega_destino_ida_03'] = "on";
   $tab_def_campos['voo_chega_destino_ida_03'] = "voo_chega_destino_ida_03";
   $tab_labels["voo_chega_destino_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_03"] : "Chegada";
   $tab_ger_campos['voo_cia_ida_03'] = "on";
   $tab_def_campos['voo_cia_ida_03'] = "voo_cia_ida_03";
   $tab_labels["voo_cia_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_03"] : "Cia.";
   $tab_ger_campos['voo_numvoo_ida_03'] = "on";
   $tab_def_campos['voo_numvoo_ida_03'] = "voo_numvoo_ida_03";
   $tab_labels["voo_numvoo_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_03"] : "Num. Voo";
   $tab_ger_campos['voo_localizador_ida_03'] = "on";
   $tab_def_campos['voo_localizador_ida_03'] = "voo_localizador_ida_03";
   $tab_labels["voo_localizador_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_03"] : "Localizador";
   $tab_ger_campos['voo_etkt_ida_03'] = "on";
   $tab_def_campos['voo_etkt_ida_03'] = "voo_etkt_ida_03";
   $tab_labels["voo_etkt_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_03"] : "Voo";
   $tab_ger_campos['voo_assento_ida_03'] = "on";
   $tab_def_campos['voo_assento_ida_03'] = "voo_assento_ida_03";
   $tab_labels["voo_assento_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_03"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_ida_03'] = "on";
   $tab_def_campos['voo_comprado_bvt_ida_03'] = "voo_comprado_bvt_ida_03";
   $tab_labels["voo_comprado_bvt_ida_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_03"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_origem_ida_04'] = "on";
   $tab_def_campos['voo_origem_ida_04'] = "voo_origem_ida_04";
   $tab_labels["voo_origem_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_ida_04"] : "Origem";
   $tab_ger_campos['voo_saida_origem_ida_04'] = "on";
   $tab_def_campos['voo_saida_origem_ida_04'] = "voo_saida_origem_ida_04";
   $tab_labels["voo_saida_origem_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_ida_04"] : "Saída";
   $tab_ger_campos['voo_destino_ida_04'] = "on";
   $tab_def_campos['voo_destino_ida_04'] = "voo_destino_ida_04";
   $tab_labels["voo_destino_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_ida_04"] : "Destino";
   $tab_ger_campos['voo_chega_destino_ida_04'] = "on";
   $tab_def_campos['voo_chega_destino_ida_04'] = "voo_chega_destino_ida_04";
   $tab_labels["voo_chega_destino_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_ida_04"] : "Chegada";
   $tab_ger_campos['voo_cia_ida_04'] = "on";
   $tab_def_campos['voo_cia_ida_04'] = "voo_cia_ida_04";
   $tab_labels["voo_cia_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_ida_04"] : "Cia.";
   $tab_ger_campos['voo_numvoo_ida_04'] = "on";
   $tab_def_campos['voo_numvoo_ida_04'] = "voo_numvoo_ida_04";
   $tab_labels["voo_numvoo_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_ida_04"] : "Num. Voo";
   $tab_ger_campos['voo_localizador_ida_04'] = "on";
   $tab_def_campos['voo_localizador_ida_04'] = "voo_localizador_ida_04";
   $tab_labels["voo_localizador_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_ida_04"] : "Localizador";
   $tab_ger_campos['voo_etkt_ida_04'] = "on";
   $tab_def_campos['voo_etkt_ida_04'] = "voo_etkt_ida_04";
   $tab_labels["voo_etkt_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_ida_04"] : "E-Ticket:";
   $tab_ger_campos['voo_assento_ida_04'] = "on";
   $tab_def_campos['voo_assento_ida_04'] = "voo_assento_ida_04";
   $tab_labels["voo_assento_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_ida_04"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_ida_04'] = "on";
   $tab_def_campos['voo_comprado_bvt_ida_04'] = "voo_comprado_bvt_ida_04";
   $tab_labels["voo_comprado_bvt_ida_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_ida_04"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_origem_volta_01'] = "on";
   $tab_def_campos['voo_origem_volta_01'] = "voo_origem_volta_01";
   $tab_labels["voo_origem_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_01"] : "Origem";
   $tab_ger_campos['voo_saida_origem_volta_01'] = "on";
   $tab_def_campos['voo_saida_origem_volta_01'] = "voo_saida_origem_volta_01";
   $tab_labels["voo_saida_origem_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_01"] : "Saída ";
   $tab_ger_campos['voo_destino_volta_01'] = "on";
   $tab_def_campos['voo_destino_volta_01'] = "voo_destino_volta_01";
   $tab_labels["voo_destino_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_01"] : "Destino";
   $tab_ger_campos['voo_chega_destino_volta_01'] = "on";
   $tab_def_campos['voo_chega_destino_volta_01'] = "voo_chega_destino_volta_01";
   $tab_labels["voo_chega_destino_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_01"] : "Chegada";
   $tab_ger_campos['voo_cia_volta_01'] = "on";
   $tab_def_campos['voo_cia_volta_01'] = "voo_cia_volta_01";
   $tab_labels["voo_cia_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_01"] : "Cia.";
   $tab_ger_campos['voo_numvoo_volta_01'] = "on";
   $tab_def_campos['voo_numvoo_volta_01'] = "voo_numvoo_volta_01";
   $tab_labels["voo_numvoo_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_01"] : "Num. Voo";
   $tab_ger_campos['voo_localizador_volta_01'] = "on";
   $tab_def_campos['voo_localizador_volta_01'] = "voo_localizador_volta_01";
   $tab_labels["voo_localizador_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_01"] : "Localizador";
   $tab_ger_campos['voo_etkt_volta_01'] = "on";
   $tab_def_campos['voo_etkt_volta_01'] = "voo_etkt_volta_01";
   $tab_labels["voo_etkt_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_01"] : "E-ticket";
   $tab_ger_campos['voo_assento_volta_01'] = "on";
   $tab_def_campos['voo_assento_volta_01'] = "voo_assento_volta_01";
   $tab_labels["voo_assento_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_01"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_volta_01'] = "on";
   $tab_def_campos['voo_comprado_bvt_volta_01'] = "voo_comprado_bvt_volta_01";
   $tab_labels["voo_comprado_bvt_volta_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_01"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_origem_volta_02'] = "on";
   $tab_def_campos['voo_origem_volta_02'] = "voo_origem_volta_02";
   $tab_labels["voo_origem_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_02"] : "Origem";
   $tab_ger_campos['voo_saida_origem_volta_02'] = "on";
   $tab_def_campos['voo_saida_origem_volta_02'] = "voo_saida_origem_volta_02";
   $tab_labels["voo_saida_origem_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_02"] : "Saída:";
   $tab_ger_campos['voo_destino_volta_02'] = "on";
   $tab_def_campos['voo_destino_volta_02'] = "voo_destino_volta_02";
   $tab_labels["voo_destino_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_02"] : "Destino";
   $tab_ger_campos['voo_chega_destino_volta_02'] = "on";
   $tab_def_campos['voo_chega_destino_volta_02'] = "voo_chega_destino_volta_02";
   $tab_labels["voo_chega_destino_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_02"] : "Chegada";
   $tab_ger_campos['voo_cia_volta_02'] = "on";
   $tab_def_campos['voo_cia_volta_02'] = "voo_cia_volta_02";
   $tab_labels["voo_cia_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_02"] : "Cia.";
   $tab_ger_campos['voo_numvoo_volta_02'] = "on";
   $tab_def_campos['voo_numvoo_volta_02'] = "voo_numvoo_volta_02";
   $tab_labels["voo_numvoo_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_02"] : "Num. Voo:";
   $tab_ger_campos['voo_localizador_volta_02'] = "on";
   $tab_def_campos['voo_localizador_volta_02'] = "voo_localizador_volta_02";
   $tab_labels["voo_localizador_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_02"] : "Localiador";
   $tab_ger_campos['voo_etkt_volta_02'] = "on";
   $tab_def_campos['voo_etkt_volta_02'] = "voo_etkt_volta_02";
   $tab_labels["voo_etkt_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_02"] : "E-ticket";
   $tab_ger_campos['voo_assento_volta_02'] = "on";
   $tab_def_campos['voo_assento_volta_02'] = "voo_assento_volta_02";
   $tab_labels["voo_assento_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_02"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_volta_02'] = "on";
   $tab_def_campos['voo_comprado_bvt_volta_02'] = "voo_comprado_bvt_volta_02";
   $tab_labels["voo_comprado_bvt_volta_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_02"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_origem_volta_03'] = "on";
   $tab_def_campos['voo_origem_volta_03'] = "voo_origem_volta_03";
   $tab_labels["voo_origem_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_03"] : "Origem";
   $tab_ger_campos['voo_saida_origem_volta_03'] = "on";
   $tab_def_campos['voo_saida_origem_volta_03'] = "voo_saida_origem_volta_03";
   $tab_labels["voo_saida_origem_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_03"] : "Saída";
   $tab_ger_campos['voo_destino_volta_03'] = "on";
   $tab_def_campos['voo_destino_volta_03'] = "voo_destino_volta_03";
   $tab_labels["voo_destino_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_03"] : "Destino";
   $tab_ger_campos['voo_chega_destino_volta_03'] = "on";
   $tab_def_campos['voo_chega_destino_volta_03'] = "voo_chega_destino_volta_03";
   $tab_labels["voo_chega_destino_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_03"] : "Chegada";
   $tab_ger_campos['voo_cia_volta_03'] = "on";
   $tab_def_campos['voo_cia_volta_03'] = "voo_cia_volta_03";
   $tab_labels["voo_cia_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_03"] : "Cia.";
   $tab_ger_campos['voo_numvoo_volta_03'] = "on";
   $tab_def_campos['voo_numvoo_volta_03'] = "voo_numvoo_volta_03";
   $tab_labels["voo_numvoo_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_03"] : "Num. Voo:";
   $tab_ger_campos['voo_localizador_volta_03'] = "on";
   $tab_def_campos['voo_localizador_volta_03'] = "voo_localizador_volta_03";
   $tab_labels["voo_localizador_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_03"] : "Localizador";
   $tab_ger_campos['voo_etkt_volta_03'] = "on";
   $tab_def_campos['voo_etkt_volta_03'] = "voo_etkt_volta_03";
   $tab_labels["voo_etkt_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_03"] : "E-ticket";
   $tab_ger_campos['voo_assento_volta_03'] = "on";
   $tab_def_campos['voo_assento_volta_03'] = "voo_assento_volta_03";
   $tab_labels["voo_assento_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_03"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_volta_03'] = "on";
   $tab_def_campos['voo_comprado_bvt_volta_03'] = "voo_comprado_bvt_volta_03";
   $tab_labels["voo_comprado_bvt_volta_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_03"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_origem_volta_04'] = "on";
   $tab_def_campos['voo_origem_volta_04'] = "voo_origem_volta_04";
   $tab_labels["voo_origem_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_origem_volta_04"] : "Origem";
   $tab_ger_campos['voo_saida_origem_volta_04'] = "on";
   $tab_def_campos['voo_saida_origem_volta_04'] = "voo_saida_origem_volta_04";
   $tab_labels["voo_saida_origem_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_saida_origem_volta_04"] : "Saída";
   $tab_ger_campos['voo_destino_volta_04'] = "on";
   $tab_def_campos['voo_destino_volta_04'] = "voo_destino_volta_04";
   $tab_labels["voo_destino_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_destino_volta_04"] : "Destino";
   $tab_ger_campos['voo_chega_destino_volta_04'] = "on";
   $tab_def_campos['voo_chega_destino_volta_04'] = "voo_chega_destino_volta_04";
   $tab_labels["voo_chega_destino_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_chega_destino_volta_04"] : "Chegada";
   $tab_ger_campos['voo_cia_volta_04'] = "on";
   $tab_def_campos['voo_cia_volta_04'] = "voo_cia_volta_04";
   $tab_labels["voo_cia_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_cia_volta_04"] : "Cia.";
   $tab_ger_campos['voo_numvoo_volta_04'] = "on";
   $tab_def_campos['voo_numvoo_volta_04'] = "voo_numvoo_volta_04";
   $tab_labels["voo_numvoo_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_numvoo_volta_04"] : "Num. Voo";
   $tab_ger_campos['voo_localizador_volta_04'] = "on";
   $tab_def_campos['voo_localizador_volta_04'] = "voo_localizador_volta_04";
   $tab_labels["voo_localizador_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_localizador_volta_04"] : "Localizador";
   $tab_ger_campos['voo_etkt_volta_04'] = "on";
   $tab_def_campos['voo_etkt_volta_04'] = "voo_etkt_volta_04";
   $tab_labels["voo_etkt_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_etkt_volta_04"] : "E-ticket";
   $tab_ger_campos['voo_assento_volta_04'] = "on";
   $tab_def_campos['voo_assento_volta_04'] = "voo_assento_volta_04";
   $tab_labels["voo_assento_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_assento_volta_04"] : "Assento";
   $tab_ger_campos['voo_comprado_bvt_volta_04'] = "on";
   $tab_def_campos['voo_comprado_bvt_volta_04'] = "voo_comprado_bvt_volta_04";
   $tab_labels["voo_comprado_bvt_volta_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_comprado_bvt_volta_04"] : "Comprado com Belvitur";
   $tab_ger_campos['voo_observacoes_ida'] = "on";
   $tab_def_campos['voo_observacoes_ida'] = "voo_observacoes_ida";
   $tab_labels["voo_observacoes_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_observacoes_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["voo_observacoes_ida"] : "";
   $tab_ger_campos['logo_hospedagem'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['logo_hospedagem'] = "logo_hospedagem";
   }
   else
   {
       $tab_def_campos['logo_hospedagem'] = "";
   }
   $tab_labels["logo_hospedagem"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_hospedagem"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_hospedagem"] : "";
   $tab_ger_campos['hosp_fantasia_hotel_01'] = "on";
   $tab_def_campos['hosp_fantasia_hotel_01'] = "hosp_fantasia_hotel_01";
   $tab_labels["hosp_fantasia_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_01"] : "Hotel";
   $tab_ger_campos['hosp_logradouro_hotel_01'] = "on";
   $tab_def_campos['hosp_logradouro_hotel_01'] = "hosp_logradouro_hotel_01";
   $tab_labels["hosp_logradouro_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_01"] : "Logradouro";
   $tab_ger_campos['hosp_numero_hotel_01'] = "on";
   $tab_def_campos['hosp_numero_hotel_01'] = "hosp_numero_hotel_01";
   $tab_labels["hosp_numero_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_01"] : "Número";
   $tab_ger_campos['hosp_complemento_hotel_01'] = "on";
   $tab_def_campos['hosp_complemento_hotel_01'] = "hosp_complemento_hotel_01";
   $tab_labels["hosp_complemento_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_01"] : "Complemento";
   $tab_ger_campos['hosp_municipio_hotel_01'] = "on";
   $tab_def_campos['hosp_municipio_hotel_01'] = "hosp_municipio_hotel_01";
   $tab_labels["hosp_municipio_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_01"] : "Município";
   $tab_ger_campos['hosp_uf_hotel_01'] = "on";
   $tab_def_campos['hosp_uf_hotel_01'] = "hosp_uf_hotel_01";
   $tab_labels["hosp_uf_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_01"] : "UF";
   $tab_ger_campos['hosp_cep_hotel_01'] = "on";
   $tab_def_campos['hosp_cep_hotel_01'] = "hosp_cep_hotel_01";
   $tab_labels["hosp_cep_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_01"] : "CEP";
   $tab_ger_campos['hosp_pais_hotel_01'] = "on";
   $tab_def_campos['hosp_pais_hotel_01'] = "hosp_pais_hotel_01";
   $tab_labels["hosp_pais_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_01"] : "Pais";
   $tab_ger_campos['hosp_acomodacao_hotel_01'] = "on";
   $tab_def_campos['hosp_acomodacao_hotel_01'] = "hosp_acomodacao_hotel_01";
   $tab_labels["hosp_acomodacao_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_01"] : "Acomodação";
   $tab_ger_campos['hosp_categoria_hotel_01'] = "on";
   $tab_def_campos['hosp_categoria_hotel_01'] = "hosp_categoria_hotel_01";
   $tab_labels["hosp_categoria_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_01"] : "Categoria";
   $tab_ger_campos['hosp_checkin_hotel_01'] = "on";
   $tab_def_campos['hosp_checkin_hotel_01'] = "hosp_checkin_hotel_01";
   $tab_labels["hosp_checkin_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_01"] : "Data CheckIn";
   $tab_ger_campos['hosp_hr_ckeckin_hotel_01'] = "on";
   $tab_def_campos['hosp_hr_ckeckin_hotel_01'] = "hosp_hr_ckeckin_hotel_01";
   $tab_labels["hosp_hr_ckeckin_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_01"] : "Hora CheckIn";
   $tab_ger_campos['hosp_checkout_hotel_01'] = "on";
   $tab_def_campos['hosp_checkout_hotel_01'] = "hosp_checkout_hotel_01";
   $tab_labels["hosp_checkout_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_01"] : "Data CheckOut";
   $tab_ger_campos['hosp_hr_ckeckout_hotel_01'] = "on";
   $tab_def_campos['hosp_hr_ckeckout_hotel_01'] = "hosp_hr_ckeckout_hotel_01";
   $tab_labels["hosp_hr_ckeckout_hotel_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_01"] : "Hora CheckOut";
   $tab_ger_campos['hosp_fantasia_hotel_02'] = "on";
   $tab_def_campos['hosp_fantasia_hotel_02'] = "hosp_fantasia_hotel_02";
   $tab_labels["hosp_fantasia_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_02"] : "Hotel";
   $tab_ger_campos['hosp_logradouro_hotel_02'] = "on";
   $tab_def_campos['hosp_logradouro_hotel_02'] = "hosp_logradouro_hotel_02";
   $tab_labels["hosp_logradouro_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_02"] : "Logradouro";
   $tab_ger_campos['hosp_numero_hotel_02'] = "on";
   $tab_def_campos['hosp_numero_hotel_02'] = "hosp_numero_hotel_02";
   $tab_labels["hosp_numero_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_02"] : "Número";
   $tab_ger_campos['hosp_complemento_hotel_02'] = "on";
   $tab_def_campos['hosp_complemento_hotel_02'] = "hosp_complemento_hotel_02";
   $tab_labels["hosp_complemento_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_02"] : "Complemento";
   $tab_ger_campos['hosp_municipio_hotel_02'] = "on";
   $tab_def_campos['hosp_municipio_hotel_02'] = "hosp_municipio_hotel_02";
   $tab_labels["hosp_municipio_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_02"] : "Município";
   $tab_ger_campos['hosp_uf_hotel_02'] = "on";
   $tab_def_campos['hosp_uf_hotel_02'] = "hosp_uf_hotel_02";
   $tab_labels["hosp_uf_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_02"] : "UF";
   $tab_ger_campos['hosp_cep_hotel_02'] = "on";
   $tab_def_campos['hosp_cep_hotel_02'] = "hosp_cep_hotel_02";
   $tab_labels["hosp_cep_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_02"] : "CEP";
   $tab_ger_campos['hosp_pais_hotel_02'] = "on";
   $tab_def_campos['hosp_pais_hotel_02'] = "hosp_pais_hotel_02";
   $tab_labels["hosp_pais_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_02"] : "País";
   $tab_ger_campos['hosp_acomodacao_hotel_02'] = "on";
   $tab_def_campos['hosp_acomodacao_hotel_02'] = "hosp_acomodacao_hotel_02";
   $tab_labels["hosp_acomodacao_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_02"] : "Acomodação";
   $tab_ger_campos['hosp_categoria_hotel_02'] = "on";
   $tab_def_campos['hosp_categoria_hotel_02'] = "hosp_categoria_hotel_02";
   $tab_labels["hosp_categoria_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_02"] : "Categoria";
   $tab_ger_campos['hosp_checkin_hotel_02'] = "on";
   $tab_def_campos['hosp_checkin_hotel_02'] = "hosp_checkin_hotel_02";
   $tab_labels["hosp_checkin_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_02"] : "Data CheckIn";
   $tab_ger_campos['hosp_hr_ckeckin_hotel_02'] = "on";
   $tab_def_campos['hosp_hr_ckeckin_hotel_02'] = "hosp_hr_ckeckin_hotel_02";
   $tab_labels["hosp_hr_ckeckin_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_02"] : "Hora CheckIn";
   $tab_ger_campos['hosp_checkout_hotel_02'] = "on";
   $tab_def_campos['hosp_checkout_hotel_02'] = "hosp_checkout_hotel_02";
   $tab_labels["hosp_checkout_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_02"] : "Data CheckOut";
   $tab_ger_campos['hosp_hr_ckeckout_hotel_02'] = "on";
   $tab_def_campos['hosp_hr_ckeckout_hotel_02'] = "hosp_hr_ckeckout_hotel_02";
   $tab_labels["hosp_hr_ckeckout_hotel_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_02"] : "Data CheckOut";
   $tab_ger_campos['hosp_fantasia_hotel_03'] = "on";
   $tab_def_campos['hosp_fantasia_hotel_03'] = "hosp_fantasia_hotel_03";
   $tab_labels["hosp_fantasia_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_03"] : "Hotel";
   $tab_ger_campos['hosp_logradouro_hotel_03'] = "on";
   $tab_def_campos['hosp_logradouro_hotel_03'] = "hosp_logradouro_hotel_03";
   $tab_labels["hosp_logradouro_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_03"] : "Logradouro";
   $tab_ger_campos['hosp_numero_hotel_03'] = "on";
   $tab_def_campos['hosp_numero_hotel_03'] = "hosp_numero_hotel_03";
   $tab_labels["hosp_numero_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_03"] : "Número";
   $tab_ger_campos['hosp_complemento_hotel_03'] = "on";
   $tab_def_campos['hosp_complemento_hotel_03'] = "hosp_complemento_hotel_03";
   $tab_labels["hosp_complemento_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_03"] : "Complemento";
   $tab_ger_campos['hosp_municipio_hotel_03'] = "on";
   $tab_def_campos['hosp_municipio_hotel_03'] = "hosp_municipio_hotel_03";
   $tab_labels["hosp_municipio_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_03"] : "Município";
   $tab_ger_campos['hosp_uf_hotel_03'] = "on";
   $tab_def_campos['hosp_uf_hotel_03'] = "hosp_uf_hotel_03";
   $tab_labels["hosp_uf_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_03"] : "UF";
   $tab_ger_campos['hosp_cep_hotel_03'] = "on";
   $tab_def_campos['hosp_cep_hotel_03'] = "hosp_cep_hotel_03";
   $tab_labels["hosp_cep_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_03"] : "CEP";
   $tab_ger_campos['hosp_pais_hotel_03'] = "on";
   $tab_def_campos['hosp_pais_hotel_03'] = "hosp_pais_hotel_03";
   $tab_labels["hosp_pais_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_03"] : "País";
   $tab_ger_campos['hosp_acomodacao_hotel_03'] = "on";
   $tab_def_campos['hosp_acomodacao_hotel_03'] = "hosp_acomodacao_hotel_03";
   $tab_labels["hosp_acomodacao_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_03"] : "Acomodação";
   $tab_ger_campos['hosp_categoria_hotel_03'] = "on";
   $tab_def_campos['hosp_categoria_hotel_03'] = "hosp_categoria_hotel_03";
   $tab_labels["hosp_categoria_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_03"] : "Categoria";
   $tab_ger_campos['hosp_checkin_hotel_03'] = "on";
   $tab_def_campos['hosp_checkin_hotel_03'] = "hosp_checkin_hotel_03";
   $tab_labels["hosp_checkin_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_03"] : "Data CheckIn";
   $tab_ger_campos['hosp_hr_ckeckin_hotel_03'] = "on";
   $tab_def_campos['hosp_hr_ckeckin_hotel_03'] = "hosp_hr_ckeckin_hotel_03";
   $tab_labels["hosp_hr_ckeckin_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_03"] : "Hora CheckIn";
   $tab_ger_campos['hosp_checkout_hotel_03'] = "on";
   $tab_def_campos['hosp_checkout_hotel_03'] = "hosp_checkout_hotel_03";
   $tab_labels["hosp_checkout_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_03"] : "Data CheckOut";
   $tab_ger_campos['hosp_hr_ckeckout_hotel_03'] = "on";
   $tab_def_campos['hosp_hr_ckeckout_hotel_03'] = "hosp_hr_ckeckout_hotel_03";
   $tab_labels["hosp_hr_ckeckout_hotel_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_03"] : "Data CheckOut";
   $tab_ger_campos['hosp_fantasia_hotel_04'] = "on";
   $tab_def_campos['hosp_fantasia_hotel_04'] = "hosp_fantasia_hotel_04";
   $tab_labels["hosp_fantasia_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_fantasia_hotel_04"] : "Hotel";
   $tab_ger_campos['hosp_logradouro_hotel_04'] = "on";
   $tab_def_campos['hosp_logradouro_hotel_04'] = "hosp_logradouro_hotel_04";
   $tab_labels["hosp_logradouro_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_logradouro_hotel_04"] : "Logradouro";
   $tab_ger_campos['hosp_numero_hotel_04'] = "on";
   $tab_def_campos['hosp_numero_hotel_04'] = "hosp_numero_hotel_04";
   $tab_labels["hosp_numero_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_numero_hotel_04"] : "Número";
   $tab_ger_campos['hosp_complemento_hotel_04'] = "on";
   $tab_def_campos['hosp_complemento_hotel_04'] = "hosp_complemento_hotel_04";
   $tab_labels["hosp_complemento_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_complemento_hotel_04"] : "Complemento";
   $tab_ger_campos['hosp_municipio_hotel_04'] = "on";
   $tab_def_campos['hosp_municipio_hotel_04'] = "hosp_municipio_hotel_04";
   $tab_labels["hosp_municipio_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_municipio_hotel_04"] : "Município";
   $tab_ger_campos['hosp_uf_hotel_04'] = "on";
   $tab_def_campos['hosp_uf_hotel_04'] = "hosp_uf_hotel_04";
   $tab_labels["hosp_uf_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_uf_hotel_04"] : "UF";
   $tab_ger_campos['hosp_cep_hotel_04'] = "on";
   $tab_def_campos['hosp_cep_hotel_04'] = "hosp_cep_hotel_04";
   $tab_labels["hosp_cep_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_cep_hotel_04"] : "CEP";
   $tab_ger_campos['hosp_pais_hotel_04'] = "on";
   $tab_def_campos['hosp_pais_hotel_04'] = "hosp_pais_hotel_04";
   $tab_labels["hosp_pais_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_pais_hotel_04"] : "País";
   $tab_ger_campos['hosp_acomodacao_hotel_04'] = "on";
   $tab_def_campos['hosp_acomodacao_hotel_04'] = "hosp_acomodacao_hotel_04";
   $tab_labels["hosp_acomodacao_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_acomodacao_hotel_04"] : "Acomodação";
   $tab_ger_campos['hosp_categoria_hotel_04'] = "on";
   $tab_def_campos['hosp_categoria_hotel_04'] = "hosp_categoria_hotel_04";
   $tab_labels["hosp_categoria_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_categoria_hotel_04"] : "Categoria";
   $tab_ger_campos['hosp_checkin_hotel_04'] = "on";
   $tab_def_campos['hosp_checkin_hotel_04'] = "hosp_checkin_hotel_04";
   $tab_labels["hosp_checkin_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkin_hotel_04"] : "Data CheckIn";
   $tab_ger_campos['hosp_hr_ckeckin_hotel_04'] = "on";
   $tab_def_campos['hosp_hr_ckeckin_hotel_04'] = "hosp_hr_ckeckin_hotel_04";
   $tab_labels["hosp_hr_ckeckin_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckin_hotel_04"] : "Hora CheckIn";
   $tab_ger_campos['hosp_checkout_hotel_04'] = "on";
   $tab_def_campos['hosp_checkout_hotel_04'] = "hosp_checkout_hotel_04";
   $tab_labels["hosp_checkout_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_checkout_hotel_04"] : "Data CheckOut";
   $tab_ger_campos['hosp_hr_ckeckout_hotel_04'] = "on";
   $tab_def_campos['hosp_hr_ckeckout_hotel_04'] = "hosp_hr_ckeckout_hotel_04";
   $tab_labels["hosp_hr_ckeckout_hotel_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_hr_ckeckout_hotel_04"] : "Hora CheckOut";
   $tab_ger_campos['hosp_observacoes'] = "on";
   $tab_def_campos['hosp_observacoes'] = "hosp_observacoes";
   $tab_labels["hosp_observacoes"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_observacoes"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["hosp_observacoes"] : "";
   $tab_ger_campos['logo_transfer'] = "on";
   if ($use_alias == "S")
   {
       $tab_def_campos['logo_transfer'] = "logo_transfer";
   }
   else
   {
       $tab_def_campos['logo_transfer'] = "";
   }
   $tab_labels["logo_transfer"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_transfer"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["logo_transfer"] : "";
   $tab_ger_campos['transfer_in_observacoes'] = "on";
   $tab_def_campos['transfer_in_observacoes'] = "transfer_in_observacoes";
   $tab_labels["transfer_in_observacoes"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["transfer_in_observacoes"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["transfer_in_observacoes"] : "";
   $tab_ger_campos['transfer_out_observacoes'] = "on";
   $tab_def_campos['transfer_out_observacoes'] = "transfer_out_observacoes";
   $tab_labels["transfer_out_observacoes"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["transfer_out_observacoes"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["transfer_out_observacoes"] : "";
   $tab_ger_campos['acompanhante_011'] = "on";
   $tab_def_campos['acompanhante_011'] = "acompanhante_011";
   $tab_labels["acompanhante_011"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_011"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_011"] : "Acompanhante 011";
   $tab_ger_campos['participante_acomp_011'] = "on";
   $tab_def_campos['participante_acomp_011'] = "participante_acomp_011";
   $tab_labels["participante_acomp_011"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_011"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_011"] : "Participante e Acompanhante 011";
   $tab_ger_campos['acompanhante_012'] = "on";
   $tab_def_campos['acompanhante_012'] = "acompanhante_012";
   $tab_labels["acompanhante_012"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_012"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_012"] : "Acompanhante 012";
   $tab_ger_campos['participante_acomp_012'] = "on";
   $tab_def_campos['participante_acomp_012'] = "participante_acomp_012";
   $tab_labels["participante_acomp_012"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_012"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_012"] : "Participante e Acompanhante 012";
   $tab_ger_campos['acompanhante_013'] = "on";
   $tab_def_campos['acompanhante_013'] = "acompanhante_013";
   $tab_labels["acompanhante_013"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_013"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_013"] : "Acompanhante 013";
   $tab_ger_campos['participante_acomp_013'] = "on";
   $tab_def_campos['participante_acomp_013'] = "participante_acomp_013";
   $tab_labels["participante_acomp_013"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_013"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_013"] : "Participante e Acompanhante 013";
   $tab_ger_campos['acompanhante_021'] = "on";
   $tab_def_campos['acompanhante_021'] = "acompanhante_021";
   $tab_labels["acompanhante_021"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_021"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_021"] : "Acompanhante 021";
   $tab_ger_campos['participante_acomp_021'] = "on";
   $tab_def_campos['participante_acomp_021'] = "participante_acomp_021";
   $tab_labels["participante_acomp_021"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_021"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_021"] : "Participante e Acompanhante 021";
   $tab_ger_campos['acompanhante_022'] = "on";
   $tab_def_campos['acompanhante_022'] = "acompanhante_022";
   $tab_labels["acompanhante_022"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_022"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_022"] : "Acompanhante 022";
   $tab_ger_campos['participante_acomp_022'] = "on";
   $tab_def_campos['participante_acomp_022'] = "participante_acomp_022";
   $tab_labels["participante_acomp_022"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_022"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_022"] : "Participante e  Acompanhante 022";
   $tab_ger_campos['acompanhante_023'] = "on";
   $tab_def_campos['acompanhante_023'] = "acompanhante_023";
   $tab_labels["acompanhante_023"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_023"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_023"] : "Acompanhante 023";
   $tab_ger_campos['participante_acomp_023'] = "on";
   $tab_def_campos['participante_acomp_023'] = "participante_acomp_023";
   $tab_labels["participante_acomp_023"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_023"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_023"] : "Participante e  Acompanhante 023";
   $tab_ger_campos['acompanhante_031'] = "on";
   $tab_def_campos['acompanhante_031'] = "acompanhante_031";
   $tab_labels["acompanhante_031"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_031"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_031"] : "Acompanhante 031";
   $tab_ger_campos['participante_acomp_031'] = "on";
   $tab_def_campos['participante_acomp_031'] = "participante_acomp_031";
   $tab_labels["participante_acomp_031"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_031"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_031"] : "Participante e  Acompanhante 031";
   $tab_ger_campos['acompanhante_032'] = "on";
   $tab_def_campos['acompanhante_032'] = "acompanhante_032";
   $tab_labels["acompanhante_032"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_032"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_032"] : "Acompanhante 032";
   $tab_ger_campos['participante_acomp_032'] = "on";
   $tab_def_campos['participante_acomp_032'] = "participante_acomp_032";
   $tab_labels["participante_acomp_032"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_032"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_032"] : "Participante e  Acompanhante 032";
   $tab_ger_campos['acompanhante_033'] = "on";
   $tab_def_campos['acompanhante_033'] = "acompanhante_033";
   $tab_labels["acompanhante_033"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_033"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["acompanhante_033"] : "Acompanhante 033";
   $tab_ger_campos['participante_acomp_033'] = "on";
   $tab_def_campos['participante_acomp_033'] = "participante_acomp_033";
   $tab_labels["participante_acomp_033"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_033"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_acomp_033"] : "Participante e  Acompanhante 033";
   $tab_ger_campos['opcional_01'] = "on";
   $tab_def_campos['opcional_01'] = "opcional_01";
   $tab_labels["opcional_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_01"] : " 01";
   $tab_ger_campos['opcional_02'] = "on";
   $tab_def_campos['opcional_02'] = "opcional_02";
   $tab_labels["opcional_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_02"] : " 02";
   $tab_ger_campos['opcional_03'] = "on";
   $tab_def_campos['opcional_03'] = "opcional_03";
   $tab_labels["opcional_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_03"] : " 03";
   $tab_ger_campos['opcional_04'] = "on";
   $tab_def_campos['opcional_04'] = "opcional_04";
   $tab_labels["opcional_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["opcional_04"] : " 04";
   $tab_ger_campos['observacao_final'] = "on";
   $tab_def_campos['observacao_final'] = "observacao_final";
   $tab_labels["observacao_final"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["observacao_final"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["observacao_final"] : "";
   $tab_ger_campos['participante_obs'] = "on";
   $tab_def_campos['participante_obs'] = "participante_obs";
   $tab_labels["participante_obs"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_obs"])) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['labels']["participante_obs"] : "";
   $tab_ger_campos['logo_bvt'] = "none";
   $tab_ger_campos['teste'] = "none";
   $tab_ger_campos['simples_mensagem'] = "none";
   $tab_ger_campos['logo_aereo'] = "none";
   $tab_ger_campos['voo_observacoes_ida'] = "none";
   $tab_ger_campos['logo_hospedagem'] = "none";
   $tab_ger_campos['hosp_observacoes'] = "none";
   $tab_ger_campos['logo_transfer'] = "none";
   $tab_ger_campos['transfer_in_observacoes'] = "none";
   $tab_ger_campos['transfer_out_observacoes'] = "none";
   $tab_ger_campos['observacao_final'] = "none";
   if (!$embbed && $_SESSION['scriptcase']['charset'] != "UTF-8") {
       foreach ($tab_labels as $Cmp => $Label) {
          $tab_labels[$Cmp] = sc_convert_encoding($Label, "UTF-8", $_SESSION['scriptcase']['charset']);
       }
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_confirmacao_viagem_rsvp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_confirmacao_viagem_rsvp']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_confirmacao_viagem_rsvp']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select'] = array();
   }
   
   if ($fsel_ok == "cmp" && !$this->restore)
   {
       $this->Sel_processa_out_sel($campos_sel);
   }
   else
   {
       if ($embbed)
       {
           ob_start();
           $this->Sel_processa_form();
           $Temp = ob_get_clean();
           echo NM_charset_to_utf8($Temp);
       }
       else
       {
           if ($this->restore)
           {
               ob_start();
           }
           $this->Sel_processa_form();
       }
   }
   exit;
   
}
function Sel_processa_out_sel($campos_sel)
{
   global $tab_ger_campos, $sc_init, $tab_def_campos, $embbed;
   $arr_temp = array();
   $campos_sel = explode("@?@", $campos_sel);
   $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_def_campos[$campo]))
       {
           $Ordem_tem_quebra = false;
           if (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_quebra']))
           {
               foreach($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_quebra'] as $campo_quebra => $resto) 
               {
                   foreach($resto as $sqldef => $ordem_ant) 
                   {
                       if ($sqldef == $tab_def_campos[$campo]) 
                       { 
                           $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_quebra'][$campo][$sqldef] = $ordem;
                           $Ordem_tem_quebra = true;
                       }   
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select'][$tab_def_campos[$campo]] = $ordem;
           }   
       }
   }
?>
    <script language="javascript"> 
<?php
   if (!$embbed)
   {
?>
      self.parent.tb_remove(); 
      parent.nm_gp_submit_ajax('inicio', ''); 
<?php
   }
   else
   {
?>
      nm_gp_submit_ajax('inicio', ''); 
<?php
   }
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
  global $sc_init, $path_img, $path_btn, $use_alias, $tab_ger_campos, $tab_def_campos, $tab_labels, $embbed, $tbar_pos;
   $size = 10;
   $_SESSION['scriptcase']['charset']  = "UTF-8";
   $save_charset = $_SESSION['scriptcase']['charset'];
   if (!$embbed) {
       $_SESSION['scriptcase']['charset'] = "UTF-8";
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
   $_SESSION['scriptcase']['charset'] = $save_charset;
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SweetBlue/Sc9_SweetBlue";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   if (!$embbed)
   {
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Belvitur Eventos - Confirmação de Viagem</TITLE>
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
<?php
}
?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <?php
 if(isset($_SESSION['scriptcase']['str_google_fonts']) && !empty($_SESSION['scriptcase']['str_google_fonts']))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['str_google_fonts'] ?>" />
 <?php
 }
 ?>
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sc_session']['path_third'] ?>/font-awesome/6/css/all.min.css" />
<?php
   }
?>
<script language="javascript"> 
<?php
if ($embbed)
{
?>
  function scSubmitOrderCampos(sPos, sType) {
    $("#id_fsel_ok_sel_ord").val(sType);
    if(sType == 'cmp')
    {
       scPackSelectedOrd();
    }
   return new Promise(function(resolve, reject) {$.ajax({
    type: "POST",
    url: "grid_confirmacao_viagem_rsvp_order_campos.php",
    data: {
     script_case_init: $("#id_script_case_init_sel_ord").val(),
     path_img: $("#id_path_img_sel_ord").val(),
     path_btn: $("#id_path_btn_sel_ord").val(),
     use_alias: $("#id_use_alias").val(),
     campos_sel: $("#id_campos_sel_sel_ord").val(),
     sel_regra: $("#id_sel_regra_sel_ord").val(),
     fsel_ok: $("#id_fsel_ok_sel_ord").val(),
     embbed_groupby: 'Y'
    }
   }).done(function(data) {
    scBtnOrderCamposHide(sPos);
    buttonunselectedOF();
    $("#sc_id_order_campos_placeholder_" + sPos).find("td").html("");
    var execString = data.toString().replace(/(\<.*?\>)/g, '');
    eval(execString).then(function(){resolve()});
   });});
  }
<?php
}
?>
 // Submeter o formularior
 //-------------------------------------
 function submit_form_Fsel_ord()
 {
     scPackSelectedOrd();
      buttonunselectedOF();
      document.Fsel_ord.submit();
 }
 function scPackSelectedOrd() {
  var fieldList, fieldName, i, selectedFields = new Array;
 fieldList = $("#sc_id_fldord_selected").sortable("toArray");
 for (i = 0; i < fieldList.length; i++) {
  fieldName  = fieldList[i].substr(14);
  selectedFields.push($("#sc_id_class_" + fieldName).val() + fieldName);
 }
 $("#id_campos_sel_sel_ord").val( selectedFields.join("@?@") );
 }
 </script>
<FORM name="Fsel_ord" method="POST">
  <INPUT type="hidden" name="script_case_init"    id="id_script_case_init_sel_ord"    value="<?php echo NM_encode_input($sc_init); ?>"> 
  <INPUT type="hidden" name="path_img"            id="id_path_img_sel_ord"            value="<?php echo NM_encode_input($path_img); ?>"> 
  <INPUT type="hidden" name="path_btn"            id="id_path_btn_sel_ord"            value="<?php echo NM_encode_input($path_btn); ?>"> 
  <INPUT type="hidden" name="use_alias"           id="id_use_alias"                   value="<?php echo NM_encode_input($use_alias); ?>"> 
  <INPUT type="hidden" name="fsel_ok"             id="id_fsel_ok_sel_ord"             value=""> 
<?php
if ($embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 10px; right: 10px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 10px; left: 10px\">";
}
?>
<?php
if (!$embbed)
{
?>
<tr>
<td>
<div class="scGridBorder">
<table width='100%' cellspacing=0 cellpadding=0>
<?php
}
$disp_rest = "none";
?>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>">
   <?php echo $this->Nm_lang['lang_btns_sort_hint']; ?>
  </td>
 </tr>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
     <table>
   <tr><td style="vertical-align: top">
 <script language="javascript" type="text/javascript">
  $(function() {
   $(".sc_ui_litem").mouseover(function() {
    $(this).css("cursor", "all-scroll");
   });
   $("#sc_id_fldord_available").sortable({
    connectWith: ".sc_ui_fldord_selected",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).show();
     $('#f_sel_sub').css('display', 'inline-block');
    }
   }).disableSelection();
   $("#sc_id_fldord_selected").sortable({
    connectWith: ".sc_ui_fldord_available",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).hide();
     $('#f_sel_sub').css('display', 'inline-block');
     display_btn_restore_ord();
    },
    change: function( event, ui ) {
     $('#f_sel_sub').css('display', 'inline-block');
      display_btn_restore_ord();
    },
    receive: function( event, ui ) {
     $('#f_sel_sub').css('display', 'inline-block');
     display_btn_restore_ord();
    }
   });
   scUpdateListHeight();
  });
  function scUpdateListHeight() {
   $("#sc_id_fldord_available").css("min-height", "<?php echo sizeof($tab_ger_campos) * 26 ?>px");
   $("#sc_id_fldord_selected").css("min-height", "<?php echo sizeof($tab_ger_campos) * 26 ?>px");
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable_ord {
   list-style-type: none;
   margin: 0;
   min-width: 120px;
  }
  .sc_ui_sortable_ord li {
   margin: 0 3px 3px 3px;
   padding: 1px 3px 1px 15px;
   min-height: 18px;
  }
  .sc_ui_sortable_ord li span {
   position: absolute;
   margin-left: -1.3em;
  }
 </style>
    <?php echo $this->Nm_lang['lang_othr_groupby_available_fld']; ?>
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_available scAppDivSelectFields" id="sc_id_fldord_available">
<?php
   if ($this->restore) {
        ob_end_clean();
        ob_start();
   }
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select'];
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if (!isset($arr_order[$tab_def_campos[$NM_cada_field]]))
           {
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo NM_encode_input($NM_cada_field); ?>">
      <?php echo $tab_labels[$NM_cada_field]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($NM_cada_field); ?>" class="scAppDivToolbarInput" style="display: none" onchange="display_btn_restore_ord();">
       <option value="+">Asc</option>
       <option value="-">Desc</option>
      </select><br/>
     </li>
<?php
           }
       }
   }
   if ($this->restore) {
       $this->Arr_result['fldord_available'] = NM_charset_to_utf8(ob_get_clean());
   }
?>
    </ul>
   </td>
   <td style="vertical-align: top">
    <?php echo $this->Nm_lang['lang_othr_groupby_selected_fld']; ?>
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_selected scAppDivSelectFields" id="sc_id_fldord_selected">
<?php
   if ($this->restore) {
       ob_end_clean();
       ob_start();
   }
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select'];
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if (isset($arr_order[$tab_def_campos[$NM_cada_field]]))
           {
               $sAscSelected  = " selected";
               $sDescSelected = "";
               if ($arr_order[$tab_def_campos[$NM_cada_field]] == "desc")
               {
                   $sAscSelected  = "";
                   $sDescSelected = " selected";
               }
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo $NM_cada_field; ?>">
      <?php echo $tab_labels[$NM_cada_field]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($NM_cada_field); ?>" class="scAppDivToolbarInput" onchange="$('#f_sel_sub').css('display', 'inline-block');display_btn_restore_ord();">
       <option value="+"<?php echo $sAscSelected; ?>>Asc</option>
       <option value="-"<?php echo $sDescSelected; ?>>Desc</option>
      </select>
     </li>
<?php
          }
       }
   }
   if ($this->restore) {
       $this->Arr_result['fldord_selected'] = NM_charset_to_utf8(ob_get_clean());
       $oJson = new Services_JSON();
       echo $oJson->encode($this->Arr_result);
       exit;
   }
?>
    </ul>
    <input type="hidden" name="campos_sel" id="id_campos_sel_sel_ord" value="">
   </td>
   </tr>
   </table>
   </td>
   </tr>
   </table>
  </td>
 </tr>
   <tr><td class="<?php echo ($embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
  if (isset($_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select']) && $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select'] != $_SESSION['sc_session'][$sc_init]['grid_confirmacao_viagem_rsvp']['ordem_select_orig']) {
      $disp_rest = "";
  }
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok_appdiv", "document.Fsel_ord.fsel_ok.value='cmp';proc_btn_ord('f_sel_sub','submit_form_Fsel_ord()')", "document.Fsel_ord.fsel_ok.value='cmp';proc_btn_ord('f_sel_sub','submit_form_Fsel_ord()')", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "proc_btn_ord('f_sel_sub','scSubmitOrderCampos(\\'" . NM_encode_input($tbar_pos) . "\\', \\'cmp\\')')", "proc_btn_ord('f_sel_sub','scSubmitOrderCampos(\\'" . NM_encode_input($tbar_pos) . "\\', \\'cmp\\')')", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp;
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "brestore_appdiv", "proc_btn_ord('Brestore_ord','restore_ord()')", "proc_btn_ord('Brestore_ord','restore_ord()')", "Brestore_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "brestore_appdiv", "proc_btn_ord('Brestore_ord','restore_ord()')", "proc_btn_ord('Brestore_ord','restore_ord()')", "Brestore_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp;
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove(); buttonunselectedOF();", "self.parent.tb_remove(); buttonunselectedOF();", "Bsair_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "'); buttonunselectedOF();", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "'); buttonunselectedOF();", "Bsair_ord", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
   </td>
   </tr>
<?php
if (!$embbed)
{
?>
</table>
</div>
</td>
</tr>
<?php
}
?>
</table>
<?php
if ($embbed)
{
?>
    </div>
<?php
}
?>
</FORM>
<script language="javascript"> 
function buttonDisable_ord(buttonId) {
    $("#" + buttonId).prop("disabled", true).addClass("disabled");
}
function buttonEnable_ord(buttonId) {
    $("#" + buttonId).prop("disabled", false).removeClass("disabled");
}
function restore_ord() {
    $.ajax({
        type: 'POST',
        url: "grid_confirmacao_viagem_rsvp_order_campos.php",
        data: {
           script_case_init: $("#id_script_case_init_sel_ord").val(),
           restore: 'ok',
        }
    })
    .done(function(retcombos) {
       eval("Combos = " + retcombos);
       $("#sc_id_fldord_available").html(Combos["fldord_available"]);
       $("#sc_id_fldord_selected").html(Combos["fldord_selected"]);
       $("#sc_id_fldord_available").html(Combos["fldord_available"]);
       $("#sc_id_fldord_selected").html(Combos["fldord_selected"]);
       buttonDisable_ord("Brestore_ord");
       buttonEnable_ord("f_sel_sub");
       $('#f_sel_sub').css('display', 'inline-block');
    });
}
function buttonSelectedOF() {
   parent.$("#ordcmp_top").addClass("selected");
   parent.$("#ordcmp_bottom").addClass("selected");
}
function buttonunselectedOF() {
   parent.$("#ordcmp_top").removeClass("selected");
   parent.$("#ordcmp_bottom").removeClass("selected");
}
function display_btn_restore_ord() {
    buttonEnable_ord("Brestore_ord");
    buttonEnable_ord("f_sel_sub");
}
function proc_btn_ord(btn, proc) {
    if (
        (document.Fsel_ord.fsel_ok.value != 'regra' && $("#" + btn).prop("disabled") == true) || 
        (document.Fsel_ord.fsel_ok.value == 'regra' && $("#id_sel_regra_sel_ord").val() == '')
    )
    {
        return;
    }
    eval (proc);
}
$( document ).ready(function() {
   buttonDisable_ord("f_sel_sub");
<?php
   if ($disp_rest == "none") {
?>
   buttonDisable_ord("Brestore_ord");
<?php
   }
?>
});
var bFixed = false;
function ajusta_window_Fsel_ord()
{
<?php
   if ($embbed)
   {
?>
  return false;
<?php
   }
?>
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window_Fsel_ord()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_ord.sel_orig),
        oDest = $(document.Fsel_ord.sel_dest),
        mHeight = Math.max(oOrig.height(), oDest.height()),
        mWidth = Math.max(oOrig.width() + 5, oDest.width() + 5);
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    oDest.height(mHeight);
    oDest.width(mWidth + 15);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 20, mt.width() + 20);
      setTimeout("ajusta_window_Fsel_ord()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 20, mt.width() + 20);
  if ("function" == typeof window.parent.resizeNestedGridIframeHeight) {
    window.parent.resizeNestedGridIframeHeight(document.body.scrollHeight, 80);
  }
}
$( document ).ready(function() {
   ajusta_window_Fsel_ord();
});
</script>
<script>
    ajusta_window_Fsel_ord();
</script>
</BODY>
</HTML>
<?php
}
}
