<?php
   include_once('grid_roomlist_rsvp_r_session.php');
   session_start();
   $_SESSION['scriptcase']['grid_roomlist_rsvp_r']['glo_nm_path_imag_temp']  = "";
   //check tmp
   if(empty($_SESSION['scriptcase']['grid_roomlist_rsvp_r']['glo_nm_path_imag_temp']))
   {
       $str_path_apl_url = $_SERVER['PHP_SELF'];
       $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
       /*check tmp*/$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
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
       if (is_file($root . $_SESSION['scriptcase']['grid_roomlist_rsvp_r']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt"))
       {
?>
           <script language="javascript">
            nm_move();
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
   $Ord_Cmp = new grid_roomlist_rsvp_r_Ord_cmp(); 
   $Ord_Cmp->Ord_cmp_init();
   
class grid_roomlist_rsvp_r_Ord_cmp
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
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select_orig']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select_orig'] = array();
   }
   $this->restore = isset($_POST['restore']) ? true : false;
   if ($this->restore && !class_exists('Services_JSON')) {
       include_once("grid_roomlist_rsvp_r_json.php");
   }
   $this->Arr_result = array();
   
   $tab_ger_campos = array();
   $tab_def_campos = array();
   $tab_labels     = array();
   $tab_ger_campos['hospede'] = "on";
   $tab_def_campos['hospede'] = "hospede";
   $tab_labels["hospede"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hospede"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hospede"] : "Hóspede";
   $tab_ger_campos['passaporte'] = "on";
   $tab_def_campos['passaporte'] = "passaporte";
   $tab_labels["passaporte"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["passaporte"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["passaporte"] : "Passaporte";
   $tab_ger_campos['rg'] = "on";
   $tab_def_campos['rg'] = "rg";
   $tab_labels["rg"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["rg"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["rg"] : "RG";
   $tab_ger_campos['cpf'] = "on";
   $tab_def_campos['cpf'] = "cpf";
   $tab_labels["cpf"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["cpf"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["cpf"] : "CPF";
   $tab_ger_campos['data_nasc'] = "on";
   $tab_def_campos['data_nasc'] = "data_nasc";
   $tab_labels["data_nasc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["data_nasc"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["data_nasc"] : "Nascimento";
   $tab_ger_campos['ddd_clelular'] = "on";
   $tab_def_campos['ddd_clelular'] = "ddd_clelular";
   $tab_labels["ddd_clelular"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["ddd_clelular"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["ddd_clelular"] : "DDD Celular";
   $tab_ger_campos['celular'] = "on";
   $tab_def_campos['celular'] = "celular";
   $tab_labels["celular"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["celular"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["celular"] : "Celular";
   $tab_ger_campos['telefone_internacional'] = "on";
   $tab_def_campos['telefone_internacional'] = "telefone_internacional";
   $tab_labels["telefone_internacional"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["telefone_internacional"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["telefone_internacional"] : "Telefone Internacional";
   $tab_ger_campos['e_mail'] = "on";
   $tab_def_campos['e_mail'] = "e_mail";
   $tab_labels["e_mail"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["e_mail"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["e_mail"] : "e-Mail";
   $tab_ger_campos['tipo_pessoa'] = "on";
   $tab_def_campos['tipo_pessoa'] = "tipo_pessoa";
   $tab_labels["tipo_pessoa"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["tipo_pessoa"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["tipo_pessoa"] : "Tipo";
   $tab_ger_campos['amq_nome_01'] = "on";
   $tab_def_campos['amq_nome_01'] = "amq_nome_01";
   $tab_labels["amq_nome_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_01"] : "Acompanhante 01 (mesmo quarto)";
   $tab_ger_campos['amq_nome_02'] = "on";
   $tab_def_campos['amq_nome_02'] = "amq_nome_02";
   $tab_labels["amq_nome_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_02"] : "Acompanhante 02";
   $tab_ger_campos['amq_nome_03'] = "on";
   $tab_def_campos['amq_nome_03'] = "amq_nome_03";
   $tab_labels["amq_nome_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_03"] : "Acompanhante 03";
   $tab_ger_campos['amq_nome_04'] = "on";
   $tab_def_campos['amq_nome_04'] = "amq_nome_04";
   $tab_labels["amq_nome_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_nome_04"] : "Acompanhante 04";
   $tab_ger_campos['amq_cpf_01'] = "on";
   $tab_def_campos['amq_cpf_01'] = "amq_cpf_01";
   $tab_labels["amq_cpf_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_01"] : "CPF Acompanhante 01";
   $tab_ger_campos['amq_cpf_02'] = "on";
   $tab_def_campos['amq_cpf_02'] = "amq_cpf_02";
   $tab_labels["amq_cpf_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_02"] : "CPF Acompanhante 02";
   $tab_ger_campos['amq_cpf_03'] = "on";
   $tab_def_campos['amq_cpf_03'] = "amq_cpf_03";
   $tab_labels["amq_cpf_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_03"] : "CPF Acompanhante 03";
   $tab_ger_campos['amq_cpf_04'] = "on";
   $tab_def_campos['amq_cpf_04'] = "amq_cpf_04";
   $tab_labels["amq_cpf_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_cpf_04"] : "CPF Acompanhante 04";
   $tab_ger_campos['amq_rg_01'] = "on";
   $tab_def_campos['amq_rg_01'] = "amq_rg_01";
   $tab_labels["amq_rg_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_01"] : "RG Acompanhante 01";
   $tab_ger_campos['amq_rg_02'] = "on";
   $tab_def_campos['amq_rg_02'] = "amq_rg_02";
   $tab_labels["amq_rg_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_02"] : "RG Acompanhante 02";
   $tab_ger_campos['amq_rg_03'] = "on";
   $tab_def_campos['amq_rg_03'] = "amq_rg_03";
   $tab_labels["amq_rg_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_03"] : "RG Acompanhante 03";
   $tab_ger_campos['amq_rg_04'] = "on";
   $tab_def_campos['amq_rg_04'] = "amq_rg_04";
   $tab_labels["amq_rg_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_rg_04"] : "RG Acompanhante 04";
   $tab_ger_campos['amq_dtnasc_01'] = "on";
   $tab_def_campos['amq_dtnasc_01'] = "amq_dtnasc_01";
   $tab_labels["amq_dtnasc_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_01"] : "Dt. Nasc. Acompanhante 01";
   $tab_ger_campos['amq_dtnasc_02'] = "on";
   $tab_def_campos['amq_dtnasc_02'] = "amq_dtnasc_02";
   $tab_labels["amq_dtnasc_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_02"] : "Dt. Nasc. Acompanhante 02";
   $tab_ger_campos['amq_dtnasc_03'] = "on";
   $tab_def_campos['amq_dtnasc_03'] = "amq_dtnasc_03";
   $tab_labels["amq_dtnasc_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_03"] : "Dt. Nasc. Acompanhante 03";
   $tab_ger_campos['amq_dtnasc_04'] = "on";
   $tab_def_campos['amq_dtnasc_04'] = "amq_dtnasc_04";
   $tab_labels["amq_dtnasc_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_dtnasc_04"] : "Dt. Nasc. Acompanhante 04";
   $tab_ger_campos['amq_docest_01'] = "on";
   $tab_def_campos['amq_docest_01'] = "amq_docest_01";
   $tab_labels["amq_docest_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_01"] : "Doc. Estrang. Acompanhante 01";
   $tab_ger_campos['amq_docest_02'] = "on";
   $tab_def_campos['amq_docest_02'] = "amq_docest_02";
   $tab_labels["amq_docest_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_02"] : "Doc. Estrang. Acompanhante 02";
   $tab_ger_campos['amq_docest_03'] = "on";
   $tab_def_campos['amq_docest_03'] = "amq_docest_03";
   $tab_labels["amq_docest_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_03"] : "Doc. Estrang. Acompanhante 03";
   $tab_ger_campos['amq_docest_04'] = "on";
   $tab_def_campos['amq_docest_04'] = "amq_docest_04";
   $tab_labels["amq_docest_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["amq_docest_04"] : "Doc. Estrang. Acompanhante 04";
   $tab_ger_campos['pmq_nome_01'] = "on";
   $tab_def_campos['pmq_nome_01'] = "pmq_nome_01";
   $tab_labels["pmq_nome_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_01"] : "Participante 01 (mesmo quarto)";
   $tab_ger_campos['pmq_nome_02'] = "on";
   $tab_def_campos['pmq_nome_02'] = "pmq_nome_02";
   $tab_labels["pmq_nome_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_02"] : "Participante 02 ";
   $tab_ger_campos['pmq_nome_03'] = "on";
   $tab_def_campos['pmq_nome_03'] = "pmq_nome_03";
   $tab_labels["pmq_nome_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_03"] : "Participante 03 ";
   $tab_ger_campos['pmq_nome_04'] = "on";
   $tab_def_campos['pmq_nome_04'] = "pmq_nome_04";
   $tab_labels["pmq_nome_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_nome_04"] : "Participante 04 ";
   $tab_ger_campos['pmq_cpf_01'] = "on";
   $tab_def_campos['pmq_cpf_01'] = "pmq_cpf_01";
   $tab_labels["pmq_cpf_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_01"] : "CPF Participante 01";
   $tab_ger_campos['pmq_cpf_02'] = "on";
   $tab_def_campos['pmq_cpf_02'] = "pmq_cpf_02";
   $tab_labels["pmq_cpf_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_02"] : "CPF Participante 02";
   $tab_ger_campos['pmq_cpf_03'] = "on";
   $tab_def_campos['pmq_cpf_03'] = "pmq_cpf_03";
   $tab_labels["pmq_cpf_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_03"] : "CPF Participante 03";
   $tab_ger_campos['pmq_cpf_04'] = "on";
   $tab_def_campos['pmq_cpf_04'] = "pmq_cpf_04";
   $tab_labels["pmq_cpf_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_cpf_04"] : "CPF Participante 04";
   $tab_ger_campos['pmq_rg_01'] = "on";
   $tab_def_campos['pmq_rg_01'] = "pmq_rg_01";
   $tab_labels["pmq_rg_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_01"] : "RG Participante 01";
   $tab_ger_campos['pmq_rg_02'] = "on";
   $tab_def_campos['pmq_rg_02'] = "pmq_rg_02";
   $tab_labels["pmq_rg_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_02"] : "RG Participante 02";
   $tab_ger_campos['pmq_rg_03'] = "on";
   $tab_def_campos['pmq_rg_03'] = "pmq_rg_03";
   $tab_labels["pmq_rg_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_03"] : "RG Participante 03";
   $tab_ger_campos['pmq_rg_04'] = "on";
   $tab_def_campos['pmq_rg_04'] = "pmq_rg_04";
   $tab_labels["pmq_rg_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_rg_04"] : "RG Participante 04";
   $tab_ger_campos['pmq_dtnasc_01'] = "on";
   $tab_def_campos['pmq_dtnasc_01'] = "pmq_dtnasc_01";
   $tab_labels["pmq_dtnasc_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_01"] : "Dt. Nasc. Participante 01";
   $tab_ger_campos['pmq_dtnasc_02'] = "on";
   $tab_def_campos['pmq_dtnasc_02'] = "pmq_dtnasc_02";
   $tab_labels["pmq_dtnasc_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_02"] : "Dt. Nasc. Participante 02";
   $tab_ger_campos['pmq_dtnasc_03'] = "on";
   $tab_def_campos['pmq_dtnasc_03'] = "pmq_dtnasc_03";
   $tab_labels["pmq_dtnasc_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_03"] : "Dt. Nasc. Participante 03";
   $tab_ger_campos['pmq_dtnasc_04'] = "on";
   $tab_def_campos['pmq_dtnasc_04'] = "pmq_dtnasc_04";
   $tab_labels["pmq_dtnasc_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_dtnasc_04"] : "Dt. Nasc. Participante 04";
   $tab_ger_campos['pmq_docest_01'] = "on";
   $tab_def_campos['pmq_docest_01'] = "pmq_docest_01";
   $tab_labels["pmq_docest_01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_01"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_01"] : "Doc. Estrang. Participante 01";
   $tab_ger_campos['pmq_docest_02'] = "on";
   $tab_def_campos['pmq_docest_02'] = "pmq_docest_02";
   $tab_labels["pmq_docest_02"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_02"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_02"] : "Doc. Estrang. Participante 02";
   $tab_ger_campos['pmq_docest_03'] = "on";
   $tab_def_campos['pmq_docest_03'] = "pmq_docest_03";
   $tab_labels["pmq_docest_03"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_03"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_03"] : "Doc. Estrang. Participante 03";
   $tab_ger_campos['pmq_docest_04'] = "on";
   $tab_def_campos['pmq_docest_04'] = "pmq_docest_04";
   $tab_labels["pmq_docest_04"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_04"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pmq_docest_04"] : "Doc. Estrang. Participante 04";
   $tab_ger_campos['publico_dsc'] = "on";
   $tab_def_campos['publico_dsc'] = "publico_dsc";
   $tab_labels["publico_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["publico_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["publico_dsc"] : "Público";
   $tab_ger_campos['hotel_dsc'] = "on";
   $tab_def_campos['hotel_dsc'] = "hotel_dsc";
   $tab_labels["hotel_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hotel_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hotel_dsc"] : "Hotel";
   $tab_ger_campos['early_checkin'] = "on";
   $tab_def_campos['early_checkin'] = "early_checkin";
   $tab_labels["early_checkin"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["early_checkin"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["early_checkin"] : "Early Checkin";
   $tab_ger_campos['late_checkout'] = "on";
   $tab_def_campos['late_checkout'] = "late_checkout";
   $tab_labels["late_checkout"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["late_checkout"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["late_checkout"] : "Late Checkout";
   $tab_ger_campos['acomodacao_dsc'] = "on";
   $tab_def_campos['acomodacao_dsc'] = "acomodacao_dsc";
   $tab_labels["acomodacao_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["acomodacao_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["acomodacao_dsc"] : "Acomodação";
   $tab_ger_campos['categoria_dsc'] = "on";
   $tab_def_campos['categoria_dsc'] = "categoria_dsc";
   $tab_labels["categoria_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["categoria_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["categoria_dsc"] : "Categoria";
   $tab_ger_campos['dt_checkin'] = "on";
   $tab_def_campos['dt_checkin'] = "dt_checkin";
   $tab_labels["dt_checkin"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["dt_checkin"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["dt_checkin"] : "CheckIn";
   $tab_ger_campos['hr_transferin'] = "on";
   $tab_def_campos['hr_transferin'] = "hr_transferin";
   $tab_labels["hr_transferin"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hr_transferin"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hr_transferin"] : "Transfer In";
   $tab_ger_campos['dt_checkout'] = "on";
   $tab_def_campos['dt_checkout'] = "dt_checkout";
   $tab_labels["dt_checkout"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["dt_checkout"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["dt_checkout"] : "CheckOut";
   $tab_ger_campos['hr_transferout'] = "on";
   $tab_def_campos['hr_transferout'] = "hr_transferout";
   $tab_labels["hr_transferout"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hr_transferout"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["hr_transferout"] : "Tranfer Out";
   $tab_ger_campos['intervalo_trout'] = "on";
   $tab_def_campos['intervalo_trout'] = "intervalo_trout";
   $tab_labels["intervalo_trout"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["intervalo_trout"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["intervalo_trout"] : "Intervalo Transf. Out";
   $tab_ger_campos['forma_pgto'] = "on";
   $tab_def_campos['forma_pgto'] = "forma_pgto";
   $tab_labels["forma_pgto"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["forma_pgto"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["forma_pgto"] : "Forma Pgto";
   $tab_ger_campos['observacoes'] = "on";
   $tab_def_campos['observacoes'] = "observacoes";
   $tab_labels["observacoes"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["observacoes"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["observacoes"] : "Observaçôes";
   $tab_ger_campos['pacote_dsc'] = "on";
   $tab_def_campos['pacote_dsc'] = "pacote_dsc";
   $tab_labels["pacote_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pacote_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["pacote_dsc"] : "Pacote";
   $tab_ger_campos['empresa'] = "on";
   $tab_def_campos['empresa'] = "empresa";
   $tab_labels["empresa"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["empresa"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["empresa"] : "Empresa";
   $tab_ger_campos['grupo'] = "on";
   $tab_def_campos['grupo'] = "grupo";
   $tab_labels["grupo"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["grupo"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["grupo"] : "Grupo";
   $tab_ger_campos['cargo'] = "on";
   $tab_def_campos['cargo'] = "cargo";
   $tab_labels["cargo"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["cargo"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["cargo"] : "Cargo";
   $tab_ger_campos['anotacoes'] = "on";
   $tab_def_campos['anotacoes'] = "anotacoes";
   $tab_labels["anotacoes"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["anotacoes"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["anotacoes"] : "Anotacoes";
   $tab_ger_campos['evento_dsc'] = "on";
   $tab_def_campos['evento_dsc'] = "evento_dsc";
   $tab_labels["evento_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["evento_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['labels']["evento_dsc"] : "Evento";
   if (!$embbed && $_SESSION['scriptcase']['charset'] != "UTF-8") {
       foreach ($tab_labels as $Cmp => $Label) {
          $tab_labels[$Cmp] = sc_convert_encoding($Label, "UTF-8", $_SESSION['scriptcase']['charset']);
       }
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_r']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_r']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_r']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select'] = array();
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
   $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_def_campos[$campo]))
       {
           $Ordem_tem_quebra = false;
           if (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_quebra']))
           {
               foreach($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_quebra'] as $campo_quebra => $resto) 
               {
                   foreach($resto as $sqldef => $ordem_ant) 
                   {
                       if ($sqldef == $tab_def_campos[$campo]) 
                       { 
                           $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_quebra'][$campo][$sqldef] = $ordem;
                           $Ordem_tem_quebra = true;
                       }   
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select'][$tab_def_campos[$campo]] = $ordem;
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
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
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
 <TITLE><?php echo $this->Nm_lang['lang_othr_grid_title'] ?> roomlist_rsvp_r</TITLE>
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
    url: "grid_roomlist_rsvp_r_order_campos.php",
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
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select'];
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
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select'];
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
  if (isset($_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select']) && $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select'] != $_SESSION['sc_session'][$sc_init]['grid_roomlist_rsvp_r']['ordem_select_orig']) {
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
        url: "grid_roomlist_rsvp_r_order_campos.php",
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
   $("#ordcmp_top").addClass("selected");
   $("#ordcmp_bottom").addClass("selected");
}
function buttonunselectedOF() {
   $("#ordcmp_top").removeClass("selected");
   $("#ordcmp_bottom").removeClass("selected");
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
   buttonSelectedOF();
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
