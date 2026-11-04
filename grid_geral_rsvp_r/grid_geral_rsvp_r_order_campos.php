<?php
   include_once('grid_geral_rsvp_r_session.php');
   session_start();
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp']  = "";
   //check tmp
   if(empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp']))
   {
       $str_path_apl_url = $_SERVER['PHP_SELF'];
       $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
       $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
       /*check tmp*/$_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
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
       if (is_file($root . $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt"))
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
   $Ord_Cmp = new grid_geral_rsvp_r_Ord_cmp(); 
   $Ord_Cmp->Ord_cmp_init();
   
class grid_geral_rsvp_r_Ord_cmp
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
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select_orig']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select_orig'] = array();
   }
   $this->restore = isset($_POST['restore']) ? true : false;
   if ($this->restore && !class_exists('Services_JSON')) {
       include_once("grid_geral_rsvp_r_json.php");
   }
   $this->Arr_result = array();
   
   $tab_ger_campos = array();
   $tab_def_campos = array();
   $tab_labels     = array();
   $tab_ger_campos['evento_id'] = "on";
   $tab_def_campos['evento_id'] = "evento_id";
   $tab_labels["evento_id"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["evento_id"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["evento_id"] : "Cod. Evento ";
   $tab_ger_campos['evento_dsc'] = "on";
   $tab_def_campos['evento_dsc'] = "evento_dsc";
   $tab_labels["evento_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["evento_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["evento_dsc"] : "Evento";
   $tab_ger_campos['nome_participante'] = "on";
   $tab_def_campos['nome_participante'] = "nome_participante";
   $tab_labels["nome_participante"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["nome_participante"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["nome_participante"] : " Participante";
   $tab_ger_campos['tipo_pessoa'] = "on";
   $tab_def_campos['tipo_pessoa'] = "tipo_pessoa";
   $tab_labels["tipo_pessoa"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tipo_pessoa"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tipo_pessoa"] : "Tipo";
   $tab_ger_campos['data_nascimento'] = "on";
   $tab_def_campos['data_nascimento'] = "data_nascimento";
   $tab_labels["data_nascimento"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_nascimento"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_nascimento"] : "Data Nascimento";
   $tab_ger_campos['rg'] = "on";
   $tab_def_campos['rg'] = "rg";
   $tab_labels["rg"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["rg"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["rg"] : "RG";
   $tab_ger_campos['nome_cracha'] = "on";
   $tab_def_campos['nome_cracha'] = "nome_cracha";
   $tab_labels["nome_cracha"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["nome_cracha"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["nome_cracha"] : "Nome Crachá";
   $tab_ger_campos['convidado_original'] = "on";
   $tab_def_campos['convidado_original'] = "convidado_original";
   $tab_labels["convidado_original"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["convidado_original"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["convidado_original"] : "Convidado Original";
   $tab_ger_campos['nome_substituto'] = "on";
   $tab_def_campos['nome_substituto'] = "nome_substituto";
   $tab_labels["nome_substituto"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["nome_substituto"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["nome_substituto"] : "Nome Substituto";
   $tab_ger_campos['acomp_mesmoquarto'] = "on";
   $tab_def_campos['acomp_mesmoquarto'] = "acomp_mesmoquarto";
   $tab_labels["acomp_mesmoquarto"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["acomp_mesmoquarto"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["acomp_mesmoquarto"] : "Acompanhante (mesmo quarto)";
   $tab_ger_campos['partici_mesmoquarto'] = "on";
   $tab_def_campos['partici_mesmoquarto'] = "partici_mesmoquarto";
   $tab_labels["partici_mesmoquarto"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["partici_mesmoquarto"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["partici_mesmoquarto"] : "Participante (mesmo quarto)";
   $tab_ger_campos['hotel_dsc'] = "on";
   $tab_def_campos['hotel_dsc'] = "hotel_dsc";
   $tab_labels["hotel_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hotel_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hotel_dsc"] : "Hotel";
   $tab_ger_campos['checkin'] = "on";
   $tab_def_campos['checkin'] = "checkin";
   $tab_labels["checkin"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["checkin"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["checkin"] : "Checkin";
   $tab_ger_campos['checkout'] = "on";
   $tab_def_campos['checkout'] = "checkout";
   $tab_labels["checkout"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["checkout"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["checkout"] : "Checkout";
   $tab_ger_campos['early_checkin'] = "on";
   $tab_def_campos['early_checkin'] = "early_checkin";
   $tab_labels["early_checkin"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["early_checkin"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["early_checkin"] : "Early Checkin";
   $tab_ger_campos['late_checkout'] = "on";
   $tab_def_campos['late_checkout'] = "late_checkout";
   $tab_labels["late_checkout"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["late_checkout"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["late_checkout"] : "Late Checkout";
   $tab_ger_campos['tamanho_camisa'] = "on";
   $tab_def_campos['tamanho_camisa'] = "tamanho_camisa";
   $tab_labels["tamanho_camisa"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tamanho_camisa"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tamanho_camisa"] : "Tamanho Camisa";
   $tab_ger_campos['tamanho_calcado'] = "on";
   $tab_def_campos['tamanho_calcado'] = "tamanho_calcado";
   $tab_labels["tamanho_calcado"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tamanho_calcado"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tamanho_calcado"] : "Tamanho Calçado";
   $tab_ger_campos['empresa'] = "on";
   $tab_def_campos['empresa'] = "empresa";
   $tab_labels["empresa"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["empresa"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["empresa"] : "Empresa";
   $tab_ger_campos['cargo'] = "on";
   $tab_def_campos['cargo'] = "cargo";
   $tab_labels["cargo"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cargo"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cargo"] : "Cargo";
   $tab_ger_campos['departamento'] = "on";
   $tab_def_campos['departamento'] = "departamento";
   $tab_labels["departamento"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["departamento"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["departamento"] : "Departamento";
   $tab_ger_campos['grupo'] = "on";
   $tab_def_campos['grupo'] = "grupo";
   $tab_labels["grupo"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["grupo"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["grupo"] : "Grupo";
   $tab_ger_campos['publico_dsc'] = "on";
   $tab_def_campos['publico_dsc'] = "publico_dsc";
   $tab_labels["publico_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["publico_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["publico_dsc"] : "Público";
   $tab_ger_campos['regional_dsc'] = "on";
   $tab_def_campos['regional_dsc'] = "regional_dsc";
   $tab_labels["regional_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["regional_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["regional_dsc"] : "Regional";
   $tab_ger_campos['data_cadastro'] = "on";
   $tab_def_campos['data_cadastro'] = "data_cadastro";
   $tab_labels["data_cadastro"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_cadastro"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_cadastro"] : "Data Cadastro";
   $tab_ger_campos['logradouro'] = "on";
   $tab_def_campos['logradouro'] = "logradouro";
   $tab_labels["logradouro"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["logradouro"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["logradouro"] : "Endereço";
   $tab_ger_campos['complemento'] = "on";
   $tab_def_campos['complemento'] = "complemento";
   $tab_labels["complemento"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["complemento"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["complemento"] : "Complemento";
   $tab_ger_campos['cidade'] = "on";
   $tab_def_campos['cidade'] = "cidade";
   $tab_labels["cidade"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cidade"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cidade"] : "Cidade";
   $tab_ger_campos['bairro'] = "on";
   $tab_def_campos['bairro'] = "bairro";
   $tab_labels["bairro"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["bairro"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["bairro"] : "Bairro";
   $tab_ger_campos['cep'] = "on";
   $tab_def_campos['cep'] = "cep";
   $tab_labels["cep"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cep"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cep"] : "Cep";
   $tab_ger_campos['uf'] = "on";
   $tab_def_campos['uf'] = "uf";
   $tab_labels["uf"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["uf"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["uf"] : "Uf";
   $tab_ger_campos['pais_dsc'] = "on";
   $tab_def_campos['pais_dsc'] = "pais_dsc";
   $tab_labels["pais_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["pais_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["pais_dsc"] : "Pais";
   $tab_ger_campos['ddd_tel01'] = "on";
   $tab_def_campos['ddd_tel01'] = "ddd_tel01";
   $tab_labels["ddd_tel01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["ddd_tel01"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["ddd_tel01"] : "DDD";
   $tab_ger_campos['tel01'] = "on";
   $tab_def_campos['tel01'] = "tel01";
   $tab_labels["tel01"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tel01"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tel01"] : "Fone";
   $tab_ger_campos['ddd_celular'] = "on";
   $tab_def_campos['ddd_celular'] = "ddd_celular";
   $tab_labels["ddd_celular"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["ddd_celular"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["ddd_celular"] : "DDD Celular";
   $tab_ger_campos['celular'] = "on";
   $tab_def_campos['celular'] = "celular";
   $tab_labels["celular"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["celular"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["celular"] : "Celular";
   $tab_ger_campos['telefone_internacional'] = "on";
   $tab_def_campos['telefone_internacional'] = "telefone_internacional";
   $tab_labels["telefone_internacional"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["telefone_internacional"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["telefone_internacional"] : "Telefone Internacional";
   $tab_ger_campos['passaporte'] = "on";
   $tab_def_campos['passaporte'] = "passaporte";
   $tab_labels["passaporte"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["passaporte"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["passaporte"] : "Passaporte";
   $tab_ger_campos['validade_passporte'] = "on";
   $tab_def_campos['validade_passporte'] = "validade_passporte";
   $tab_labels["validade_passporte"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["validade_passporte"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["validade_passporte"] : "Validade Passporte";
   $tab_ger_campos['cpf'] = "on";
   $tab_def_campos['cpf'] = "cpf";
   $tab_labels["cpf"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cpf"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cpf"] : "CPF";
   $tab_ger_campos['filiacao'] = "on";
   $tab_def_campos['filiacao'] = "filiacao";
   $tab_labels["filiacao"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["filiacao"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["filiacao"] : "Filiacao";
   $tab_ger_campos['fumante'] = "on";
   $tab_def_campos['fumante'] = "fumante";
   $tab_labels["fumante"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["fumante"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["fumante"] : "Fumante";
   $tab_ger_campos['restricao_alimentar'] = "on";
   $tab_def_campos['restricao_alimentar'] = "restricao_alimentar";
   $tab_labels["restricao_alimentar"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["restricao_alimentar"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["restricao_alimentar"] : "Restrição Alimentar";
   $tab_ger_campos['e_mail'] = "on";
   $tab_def_campos['e_mail'] = "e_mail";
   $tab_labels["e_mail"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["e_mail"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["e_mail"] : "E Mail";
   $tab_ger_campos['atualizacao_presenca'] = "on";
   $tab_def_campos['atualizacao_presenca'] = "atualizacao_presenca";
   $tab_labels["atualizacao_presenca"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["atualizacao_presenca"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["atualizacao_presenca"] : "Atualizacao Presenca";
   $tab_ger_campos['presenca'] = "on";
   $tab_def_campos['presenca'] = "presenca";
   $tab_labels["presenca"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca"] : "Confirmação da Presença";
   $tab_ger_campos['dt_confirm_presenca'] = "on";
   $tab_def_campos['dt_confirm_presenca'] = "dt_confirm_presenca";
   $tab_labels["dt_confirm_presenca"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["dt_confirm_presenca"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["dt_confirm_presenca"] : "Dt. Confirm. Presença";
   $tab_ger_campos['presenca_motivo'] = "on";
   $tab_def_campos['presenca_motivo'] = "presenca_motivo";
   $tab_labels["presenca_motivo"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca_motivo"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca_motivo"] : "Presenca Motivo";
   $tab_ger_campos['presenca_atendente'] = "on";
   $tab_def_campos['presenca_atendente'] = "presenca_atendente";
   $tab_labels["presenca_atendente"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca_atendente"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca_atendente"] : "Presença Atendente";
   $tab_ger_campos['presenca_obs'] = "on";
   $tab_def_campos['presenca_obs'] = "presenca_obs";
   $tab_labels["presenca_obs"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca_obs"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["presenca_obs"] : "Presença Obs";
   $tab_ger_campos['contato_antendente'] = "on";
   $tab_def_campos['contato_antendente'] = "contato_antendente";
   $tab_labels["contato_antendente"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["contato_antendente"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["contato_antendente"] : "Contato Antendente";
   $tab_ger_campos['data_contato'] = "on";
   $tab_def_campos['data_contato'] = "data_contato";
   $tab_labels["data_contato"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_contato"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_contato"] : "Data do Contato";
   $tab_ger_campos['motivo_contato'] = "on";
   $tab_def_campos['motivo_contato'] = "motivo_contato";
   $tab_labels["motivo_contato"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["motivo_contato"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["motivo_contato"] : "Motivo Contato";
   $tab_ger_campos['obs_contato'] = "on";
   $tab_def_campos['obs_contato'] = "obs_contato";
   $tab_labels["obs_contato"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["obs_contato"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["obs_contato"] : "Obs Contato";
   $tab_ger_campos['status_contato'] = "on";
   $tab_def_campos['status_contato'] = "status_contato";
   $tab_labels["status_contato"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["status_contato"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["status_contato"] : "Contato Status";
   $tab_ger_campos['hora_saida_ida'] = "on";
   $tab_def_campos['hora_saida_ida'] = "hora_saida_ida";
   $tab_labels["hora_saida_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_saida_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_saida_ida"] : "Hora Saida Ida";
   $tab_ger_campos['trecho'] = "on";
   $tab_def_campos['trecho'] = "trecho";
   $tab_labels["trecho"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["trecho"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["trecho"] : "Trecho";
   $tab_ger_campos['hotel_ida_dsc'] = "on";
   $tab_def_campos['hotel_ida_dsc'] = "hotel_ida_dsc";
   $tab_labels["hotel_ida_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hotel_ida_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hotel_ida_dsc"] : "Hotel Ida ";
   $tab_ger_campos['comprada_bvt_ida'] = "on";
   $tab_def_campos['comprada_bvt_ida'] = "comprada_bvt_ida";
   $tab_labels["comprada_bvt_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["comprada_bvt_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["comprada_bvt_ida"] : "Comprada Bvt Ida";
   $tab_ger_campos['data_saida_ida'] = "on";
   $tab_def_campos['data_saida_ida'] = "data_saida_ida";
   $tab_labels["data_saida_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_saida_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_saida_ida"] : "Data Saida Ida";
   $tab_ger_campos['origem_dsc_ida'] = "on";
   $tab_def_campos['origem_dsc_ida'] = "origem_dsc_ida";
   $tab_labels["origem_dsc_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["origem_dsc_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["origem_dsc_ida"] : "Origem Ida";
   $tab_ger_campos['destino_dsc_ida'] = "on";
   $tab_def_campos['destino_dsc_ida'] = "destino_dsc_ida";
   $tab_labels["destino_dsc_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["destino_dsc_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["destino_dsc_ida"] : "Destino Ida";
   $tab_ger_campos['voo_ida'] = "on";
   $tab_def_campos['voo_ida'] = "voo_ida";
   $tab_labels["voo_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["voo_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["voo_ida"] : "Voo Ida";
   $tab_ger_campos['cia_dsc_ida'] = "on";
   $tab_def_campos['cia_dsc_ida'] = "cia_dsc_ida";
   $tab_labels["cia_dsc_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cia_dsc_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cia_dsc_ida"] : "Cia. Ida";
   $tab_ger_campos['localizador_ida'] = "on";
   $tab_def_campos['localizador_ida'] = "localizador_ida";
   $tab_labels["localizador_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["localizador_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["localizador_ida"] : "Localizador Ida";
   $tab_ger_campos['etkt_ida'] = "on";
   $tab_def_campos['etkt_ida'] = "etkt_ida";
   $tab_labels["etkt_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["etkt_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["etkt_ida"] : "TKT Ida";
   $tab_ger_campos['data_chegada_ida'] = "on";
   $tab_def_campos['data_chegada_ida'] = "data_chegada_ida";
   $tab_labels["data_chegada_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_chegada_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_chegada_ida"] : "Data Chegada Ida";
   $tab_ger_campos['hora_chegada_ida'] = "on";
   $tab_def_campos['hora_chegada_ida'] = "hora_chegada_ida";
   $tab_labels["hora_chegada_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_chegada_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_chegada_ida"] : "Hora Chegada Ida";
   $tab_ger_campos['status_aereo_ida'] = "on";
   $tab_def_campos['status_aereo_ida'] = "status_aereo_ida";
   $tab_labels["status_aereo_ida"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["status_aereo_ida"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["status_aereo_ida"] : "Status Aéreo Ida";
   $tab_ger_campos['trecho_volta'] = "on";
   $tab_def_campos['trecho_volta'] = "trecho_volta";
   $tab_labels["trecho_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["trecho_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["trecho_volta"] : "Trecho";
   $tab_ger_campos['hotel_volta_dsc'] = "on";
   $tab_def_campos['hotel_volta_dsc'] = "hotel_volta_dsc";
   $tab_labels["hotel_volta_dsc"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hotel_volta_dsc"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hotel_volta_dsc"] : "Hotel Volta";
   $tab_ger_campos['hr_transfer_volta'] = "on";
   $tab_def_campos['hr_transfer_volta'] = "hr_transfer_volta";
   $tab_labels["hr_transfer_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hr_transfer_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hr_transfer_volta"] : "Transfer Volta";
   $tab_ger_campos['comprada_bvt_volta'] = "on";
   $tab_def_campos['comprada_bvt_volta'] = "comprada_bvt_volta";
   $tab_labels["comprada_bvt_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["comprada_bvt_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["comprada_bvt_volta"] : "Comprada Bvt Volta";
   $tab_ger_campos['data_saida_volta'] = "on";
   $tab_def_campos['data_saida_volta'] = "data_saida_volta";
   $tab_labels["data_saida_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_saida_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_saida_volta"] : "Data Saida Volta";
   $tab_ger_campos['hora_saida_volta'] = "on";
   $tab_def_campos['hora_saida_volta'] = "hora_saida_volta";
   $tab_labels["hora_saida_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_saida_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_saida_volta"] : "Hora Saida Volta";
   $tab_ger_campos['data_chegada_volta'] = "on";
   $tab_def_campos['data_chegada_volta'] = "data_chegada_volta";
   $tab_labels["data_chegada_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_chegada_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["data_chegada_volta"] : "Data Chegada Volta";
   $tab_ger_campos['hora_chegada_volta'] = "on";
   $tab_def_campos['hora_chegada_volta'] = "hora_chegada_volta";
   $tab_labels["hora_chegada_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_chegada_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hora_chegada_volta"] : "Hora Chegada Volta";
   $tab_ger_campos['origem_dsc_volta'] = "on";
   $tab_def_campos['origem_dsc_volta'] = "origem_dsc_volta";
   $tab_labels["origem_dsc_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["origem_dsc_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["origem_dsc_volta"] : "Origem Volta";
   $tab_ger_campos['destino_dsc_volta'] = "on";
   $tab_def_campos['destino_dsc_volta'] = "destino_dsc_volta";
   $tab_labels["destino_dsc_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["destino_dsc_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["destino_dsc_volta"] : "Destino Volta";
   $tab_ger_campos['cia_dsc_volta'] = "on";
   $tab_def_campos['cia_dsc_volta'] = "cia_dsc_volta";
   $tab_labels["cia_dsc_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cia_dsc_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["cia_dsc_volta"] : "Cia. Volta";
   $tab_ger_campos['voo_volta'] = "on";
   $tab_def_campos['voo_volta'] = "voo_volta";
   $tab_labels["voo_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["voo_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["voo_volta"] : "Voo Volta";
   $tab_ger_campos['localizador_volta'] = "on";
   $tab_def_campos['localizador_volta'] = "localizador_volta";
   $tab_labels["localizador_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["localizador_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["localizador_volta"] : "Localizador Volta";
   $tab_ger_campos['etkt_volta'] = "on";
   $tab_def_campos['etkt_volta'] = "etkt_volta";
   $tab_labels["etkt_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["etkt_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["etkt_volta"] : "TKT Volta";
   $tab_ger_campos['status_aereo_volta'] = "on";
   $tab_def_campos['status_aereo_volta'] = "status_aereo_volta";
   $tab_labels["status_aereo_volta"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["status_aereo_volta"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["status_aereo_volta"] : "Status Aéreo Volta";
   $tab_ger_campos['tipo_transfer'] = "on";
   $tab_def_campos['tipo_transfer'] = "tipo_transfer";
   $tab_labels["tipo_transfer"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tipo_transfer"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["tipo_transfer"] : "Tipo Transfer";
   $tab_ger_campos['dt_chegada_proprio'] = "on";
   $tab_def_campos['dt_chegada_proprio'] = "dt_chegada_proprio";
   $tab_labels["dt_chegada_proprio"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["dt_chegada_proprio"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["dt_chegada_proprio"] : "Data Chegada Próprio";
   $tab_ger_campos['hr_chegada_proprio'] = "on";
   $tab_def_campos['hr_chegada_proprio'] = "hr_chegada_proprio";
   $tab_labels["hr_chegada_proprio"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hr_chegada_proprio"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["hr_chegada_proprio"] : "Hora Chegada Próprio";
   $tab_ger_campos['valor_diaria'] = "on";
   $tab_def_campos['valor_diaria'] = "valor_diaria";
   $tab_labels["valor_diaria"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["valor_diaria"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["valor_diaria"] : "Valor Diaria";
   $tab_ger_campos['valor_taxa'] = "on";
   $tab_def_campos['valor_taxa'] = "valor_taxa";
   $tab_labels["valor_taxa"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["valor_taxa"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["valor_taxa"] : "Valor Taxa";
   $tab_ger_campos['obs_transfer'] = "on";
   $tab_def_campos['obs_transfer'] = "obs_transfer";
   $tab_labels["obs_transfer"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["obs_transfer"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["obs_transfer"] : "Obs. Transfer";
   $tab_ger_campos['anotacoes'] = "on";
   $tab_def_campos['anotacoes'] = "anotacoes";
   $tab_labels["anotacoes"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["anotacoes"])) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['labels']["anotacoes"] : "Anotacoes";
   $tab_ger_campos['acomp_mesmoquarto'] = "none";
   $tab_ger_campos['partici_mesmoquarto'] = "none";
   $tab_ger_campos['presenca_obs'] = "none";
   $tab_ger_campos['obs_contato'] = "none";
   $tab_ger_campos['anotacoes'] = "none";
   if (!$embbed && $_SESSION['scriptcase']['charset'] != "UTF-8") {
       foreach ($tab_labels as $Cmp => $Label) {
          $tab_labels[$Cmp] = sc_convert_encoding($Label, "UTF-8", $_SESSION['scriptcase']['charset']);
       }
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select'] = array();
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
   $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_def_campos[$campo]))
       {
           $Ordem_tem_quebra = false;
           if (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_quebra']))
           {
               foreach($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_quebra'] as $campo_quebra => $resto) 
               {
                   foreach($resto as $sqldef => $ordem_ant) 
                   {
                       if ($sqldef == $tab_def_campos[$campo]) 
                       { 
                           $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_quebra'][$campo][$sqldef] = $ordem;
                           $Ordem_tem_quebra = true;
                       }   
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select'][$tab_def_campos[$campo]] = $ordem;
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
 <TITLE><?php echo $this->Nm_lang['lang_othr_grid_title'] ?> geral_rsvp_r</TITLE>
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
    url: "grid_geral_rsvp_r_order_campos.php",
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
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select'];
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
   $arr_order = ($this->restore) ? $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select_orig'] : $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select'];
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
  if (isset($_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select']) && $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select'] != $_SESSION['sc_session'][$sc_init]['grid_geral_rsvp_r']['ordem_select_orig']) {
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
        url: "grid_geral_rsvp_r_order_campos.php",
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
