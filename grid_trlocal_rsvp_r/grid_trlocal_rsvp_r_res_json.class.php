<?php

class grid_trlocal_rsvp_r_res_json
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $array_titulos;
   var $array_linhas;
   var $campo_titulo;

   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 

   function __construct()
   {
      $this->nm_data   = new nm_data("pt_br");
   }

   function monta_json()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_res_grid']))
      {
          return;
      }
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Json_f);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $result_json = json_encode($this->Arr_result, JSON_UNESCAPED_UNICODE);
          if ($result_json == false)
          {
              $oJson = new Services_JSON();
              $result_json = $oJson->encode($this->Arr_result);
          }
          echo $result_json;
          exit;
      }
      else
      {
          $this->progress_bar_end();
      }
   }

   function inicializa_vars()
   {
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Json_use_label = true;
      $this->Json_format = false;
      if (isset($_REQUEST['nm_json_label']) && !empty($_REQUEST['nm_json_label']))
      {
          $this->Json_use_label = ($_REQUEST['nm_json_label'] == "S") ? true : false;
      }
      if (isset($_REQUEST['nm_json_format']) && !empty($_REQUEST['nm_json_format']))
      {
          $this->Json_format = ($_REQUEST['nm_json_format'] == "S") ? true : false;
      }
      $this->Json_password  = "";
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
      $this->array_titulos = array();
      $this->array_linhas  = array();
      $this->campo_titulo  = array();
      $this->nm_data       = new nm_data("pt_br");
      $this->Arquivo       = "sc_json";
      $this->Arquivo      .= "_" . date('YmdHis') . "_" . rand(0, 1000);
      $this->Arq_zip       = $this->Arquivo . "_grid_trlocal_rsvp_r.zip";
      $this->Arquivo      .= "_grid_trlocal_rsvp_r";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_res_grid']))
      {
          $this->Arquivo      .= "_" . $this->Ini->Nm_lang['lang_othr_smry_titl'];
      }
      $this->Arquivo      .= ".json";
      $this->Tit_doc       = "grid_trlocal_rsvp_r.json";
      $this->Tit_zip       = "grid_trlocal_rsvp_r.zip";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_name']);
      }
      $this->Res       = new grid_trlocal_rsvp_r_resumo("out");
      $this->prep_modulos("Res");
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_res_grid']) && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_trlocal_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_return']);
          $this->pb->setTotalSteps(100);
          $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
          $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
          $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
          $this->pb->addSteps(50);
      }
   }

   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   function grava_arquivo()
   {
      $this->Json_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $this->Zip_f  = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      $json_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_use_label']  = $this->Json_use_label;
      $this->Res->resumo_export();
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_use_label']);
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_res_grid']) && !$this->Ini->sc_export_ajax) {
          $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
          $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
          $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
          $this->pb->addSteps(30);
      }

        $this->json_registro = [];

        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_trlocal_rsvp_r'] ['export_data'] as $exportRowInfo) {
            if ($exportRowInfo['row_total']) {
                $rowLabel = $exportRowInfo['row_label'];
            } else {
                $rowLabel = implode('_', $exportRowInfo['row_parameters']);
            }

            $this->json_registro[$rowLabel] = [];

            foreach ($exportRowInfo['column_list'] as $exportColumnInfo) {
                $thisMetricLabel = $this->Json_use_label ? $exportColumnInfo['metric_label'] : $exportColumnInfo['metric_name'];

                if ($exportColumnInfo['column_total']) {
                    $columnLabel = "{$exportColumnInfo['column_label']}_{$thisMetricLabel}";
                } else {
                    $columnLabel = implode('_', array_merge($exportColumnInfo['column_parameters'], [$thisMetricLabel]));
                }

                $this->json_registro[$rowLabel] [$columnLabel] = $exportColumnInfo['metric_value'];
            }
        }

      $result_json = json_encode($this->json_registro, JSON_UNESCAPED_UNICODE);
      if ($result_json == false)
      {
          $oJson = new Services_JSON();
          $result_json = $oJson->encode($this->json_registro);
      }
      fwrite($json_f, $result_json);
      fclose($json_f);
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_res_grid']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_res_file']['json'] = $this->Json_f;
      }
      elseif ($this->Json_password != "")
      { 
          $str_zip = "";
          $Zip_f = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
          $Arq_input  = (FALSE !== strpos($this->Json_f, ' ')) ? " \"" . $this->Json_f . "\"" :  $this->Json_f;
          if (is_file($Zip_f)) {
              unlink($Zip_f);
          }
          if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
          {
              chdir($this->Ini->path_third . "/zip/windows");
              $str_zip = "zip.exe -P -j " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
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
              $str_zip = "./7za -p" . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
          }
          elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
          {
              chdir($this->Ini->path_third . "/zip/mac/bin");
              $str_zip = "./7za -p" . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
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
          unlink($Arq_input);
          $this->Arquivo = $this->Arq_zip;
          $this->Json_f   = $this->Zip_f;
          $this->Tit_doc = $this->Tit_zip;
      } 
   }

   function grava_linha()
   {
      $contr_rowspan = "";
      $tit_rowspan   = "";
      foreach ($this->array_linhas as $lines)
      {
          $col           = 0;
          $lab           = "";
          foreach ($lines as $columns)
          {
              if (0 <= $columns['level'])
              {
                  if (is_array($columns['label'])) {
                      $columns['label'] = "";
                  }
                  $cada_dado = $columns['label'];
                  $cada_dado = str_replace("&nbsp;", "", $cada_dado);
                  $cada_dado = NM_charset_to_utf8($cada_dado);
                  if (isset($columns['rowspan']) && $columns['rowspan'] > 1)
                  {
                      $contr_rowspan = $columns['rowspan'];
                      $tit_rowspan   = (!empty($tit_rowspan)) ? "_" . $cada_dado : $cada_dado;
                  }
                  else
                  {
                     $lab .= (empty($lab)) ? $cada_dado : "_" . $cada_dado;
                  }
              }
              else
              {
                  if (is_array($columns['value'])) {
                      $columns['value'] = "";
                  }
                  if ($this->Json_format)
                  {
                      $cada_dado = grid_trlocal_rsvp_r_resumo::formatValue($columns['format'], $columns['value'], true);
                  }
                  else
                  {
                      $cada_dado = $columns['value'];
                  }
                  $cada_tit  = NM_charset_to_utf8($this->campo_titulo[$col]);
                  $this->json_registro[$lab][$cada_tit] = $cada_dado;
                  $col++;
              }
          }
      }
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
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_file_msge']);
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   function monta_html()
   {
      global $nm_url_saida;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE> :: JSON</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
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
   <td class="scExportTitle" style="height: 25px">JSON</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_trlocal_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_trlocal_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['json_return']); ?>"> 
</FORM> 
</td></tr></table>
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
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
              if ($tam_campo >= $cont2)
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
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
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
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 

function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  	
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($rs[0][0])) {			
		switch($tipo) {
			case 'nivel':
				$ret = $rs[0][1];
				break;
			case 'nome':
				$ret = $rs[0][3];
				break;
			case 'cpf':
				$ret = $rs[0][4];
				break;
		}	 
	
	} else {
		$ret = 'ERRO';
	}	
	return $ret;
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}


function PrepReloc($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;
		$ret = 'ADICIONA ERRO';			
		$valor_y = 'Y';
		$valor_p = 'P';
		$valor_l = 'L';
	
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($rs[0][0])) {
				$nome_empresa = $rs[0][2];
			}
		}		
		
		if ($vp_tipoPessoa == 'P') {
			$sqld="
			DELETE FROM 
				trlocal_rsvp_r
			WHERE   
				id_evento = ".$this->Db->qstr($vp_evento)."
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
      
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
		
		}	
		if ($vp_tipoPessoa == 'P') {
			if($vp_nivel <> 'CONVIDADO') {
				
				$sqlMestre = "				
				SELECT
					participantes_rsvp.part_id_evento AS evt,                         
					participantes_rsvp.nome_pessoa AS p_nome,                          
					participantes_rsvp.part_dt_nasc AS dt_nasc,		                             
					participantes_rsvp.part_rg AS rg,                             
					transfer_rsvp.tra_cpf_particip AS cpf,                        
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,   
					participantes_rsvp.part_celeular_01 AS p_celular_01,          
					participantes_rsvp.part_id_evento_publico AS p_publico,       
					participantes_rsvp.part_id_evento_regional AS p_regional,     
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                     
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                     
					transfer_rsvp.tra_origem_ida_local AS origem_ida,  
					transfer_rsvp.tra_destino_ida_local AS destino_ida,                      
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                 
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                 
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                          
					transfer_rsvp.tra_tipo AS tipo_transfer,		                   
					transfer_rsvp.tra_status AS t_status,                         
					transfer_rsvp.tra_ativo AS ativo,                             
					participantes_rsvp.part_cod_usuario AS usuario,               
					transfer_rsvp.tra_observacao AS obs				
				FROM
					transfer_rsvp
				RIGHT JOIN 
					participantes_rsvp	
				ON 	
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
				AND
					participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."				
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)." 
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 
				AND	
					participantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				AND
					transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
				ORDER BY				 
					participantes_rsvp.nome_pessoa					
				";					
			} else {
				$sqlMestre = "				
				SELECT
					participantes_rsvp.part_id_evento AS evt,                         
					participantes_rsvp.nome_pessoa AS p_nome,                          
					participantes_rsvp.part_dt_nasc AS dt_nasc,		                             
					participantes_rsvp.part_rg AS rg,                             
					transfer_rsvp.tra_cpf_particip AS cpf,                        
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,   
					participantes_rsvp.part_celeular_01 AS p_celular_01,          
					participantes_rsvp.part_id_evento_publico AS p_publico,       
					participantes_rsvp.part_id_evento_regional AS p_regional,     
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                     
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                     
					transfer_rsvp.tra_origem_ida_local AS origem_ida,  
					transfer_rsvp.tra_destino_ida_local AS destino_ida,                      
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                 
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                 
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                          
					transfer_rsvp.tra_tipo AS tipo_transfer,		                   
					transfer_rsvp.tra_status AS t_status,                         
					transfer_rsvp.tra_ativo AS ativo,                             
					participantes_rsvp.part_cod_usuario AS usuario,               
					transfer_rsvp.tra_observacao AS obs,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				RIGHT JOIN 
					participantes_rsvp	
				ON 	
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
				AND
					participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."				
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)." 
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 
				AND	
					participantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				AND
					transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY				 
					participantes_rsvp.nome_pessoa					
				";	
			}
			$_passa_part = true;
		} else {					
			if($vp_nivel <> 'CONVIDADO') {
				$sqlMestre = "		
				SELECT							
					acompanhantes_rsvp.part_id_evento AS evt,				                      
					acompanhantes_rsvp.part_dt_nasc AS dt_nasc,		                          
					acompanhantes_rsvp.part_rg AS rg,                             
					transfer_rsvp.tra_cpf_particip AS cpf,                       
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,  
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01,         
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,      
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,    
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                    
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                    
					transfer_rsvp.tra_origem_ida_local AS origem_ida,                     
					transfer_rsvp.tra_destino_ida_local AS destino_ida,				       			
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                         
					transfer_rsvp.tra_tipo AS tipo_transfer,					 				                  
					transfer_rsvp.tra_status AS t_status,                        
					transfer_rsvp.tra_ativo AS ativo,                            
					acompanhantes_rsvp.part_cod_usuario AS usuario,              
					transfer_rsvp.tra_observacao AS obs	   														     
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					acompanhantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)." 
				AND
					acompanhantes_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."
				AND
					acompanhantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)." 	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 
				AND
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf	
				ORDER BY				 
					transfer_rsvp.tra_cpf_particip			
				";
			} else {
				$sqlMestre = "		
				SELECT							
					acompanhantes_rsvp.part_id_evento AS evt,				                      
					acompanhantes_rsvp.part_dt_nasc AS dt_nasc,		                          
					acompanhantes_rsvp.part_rg AS rg,                             
					transfer_rsvp.tra_cpf_particip AS cpf,                       
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,  
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01,         
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,      
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,    
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                    
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                    
					transfer_rsvp.tra_origem_ida_local AS origem_ida,                     
					transfer_rsvp.tra_destino_ida_local AS destino_ida,				       			
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                         
					transfer_rsvp.tra_tipo AS tipo_transfer,					 				                  
					transfer_rsvp.tra_status AS t_status,                        
					transfer_rsvp.tra_ativo AS ativo,                            
					acompanhantes_rsvp.part_cod_usuario AS usuario,              
					transfer_rsvp.tra_observacao AS obs,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					acompanhantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)." 
				AND
					acompanhantes_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."
				AND
					acompanhantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)." 	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 	
				AND
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY				 
					transfer_rsvp.tra_cpf_particip			
				";				
			}
			$_passa_part == true;	
		}

		 
      $nm_select = $sqlMestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsm = false;
          $rsm_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_mestre = sizeof($rsm );		
		if ($reg_mestre > 0) {					
			
			
			for ($i=0;$i<$reg_mestre;++$i) {	
				if ($vp_tipoPessoa == 'P') {
					$w_id_evento			= $rsm[$i][0];          
					$w_participante			= $rsm[$i][1];       
					$w_dt_nasc		        = $rsm[$i][2];	    
					$w_rg                   = $rsm[$i][3]; 
					$w_cpf_particip         = $rsm[$i][4]; 
					$w_ddd_celular_01       = $rsm[$i][5]; 
					$w_celeular_01          = $rsm[$i][6]; 
					$w_id_evento_publico    = $rsm[$i][7]; 
					$w_evento_regional      = $rsm[$i][8]; 
					$w_dt_ida_local         = $rsm[$i][9]; 
					$w_hr_ida_local         = $rsm[$i][10];			
					$w_origem_ida 			= $rsm[$i][11];       
					$w_destino_ida 			= $rsm[$i][12];      
					$w_dt_volta_local       = $rsm[$i][13];
					$w_hr_volta_local       = $rsm[$i][14];
					$w_origem_volta 		= $rsm[$i][15];      
					$w_destino_volta 		= $rsm[$i][16];     
					$w_id_hotel             = $rsm[$i][17];
					$w_tipo_transfer		= $rsm[$i][18];      
					$w_status               = $rsm[$i][19];
					$w_ativo                = $rsm[$i][20];
					$w_observacao           = $rsm[$i][22];														
					$w_tipo_pessoa  = "PARTICIPANTE";		
					$w_id_usuario_relato = $vp_usuario;
				} else {
					$w_id_evento			= $rsm[$i][0];          					
					$w_dt_nasc		        = $rsm[$i][1];	    
					$w_rg                   = $rsm[$i][2]; 
					$w_cpf_particip         = $rsm[$i][3]; 
					$w_ddd_celular_01       = $rsm[$i][4]; 
					$w_celeular_01          = $rsm[$i][5]; 
					$w_id_evento_publico    = $rsm[$i][6]; 
					$w_evento_regional      = $rsm[$i][7]; 
					$w_dt_ida_local         = $rsm[$i][8]; 
					$w_hr_ida_local         = $rsm[$i][9];			
					$w_origem_ida 			= $rsm[$i][10];       
					$w_destino_ida 			= $rsm[$i][11];      
					$w_dt_volta_local       = $rsm[$i][12];
					$w_hr_volta_local       = $rsm[$i][13];
					$w_origem_volta 		= $rsm[$i][14];      
					$w_destino_volta 		= $rsm[$i][15];     
					$w_id_hotel             = $rsm[$i][16];
					$w_tipo_transfer		= $rsm[$i][17];      
					$w_status               = $rsm[$i][18];
					$w_ativo                = $rsm[$i][19];
					$w_observacao           = $rsm[$i][21];		
					$w_tipo_pessoa  = "ACOMPANHANTE";
					$w_id_usuario_relato = $vp_usuario;
				}					
				if ($w_id_evento_publico <> '0') {
					$sqlPub = "			
					SELECT
						publico_id,
						publico_nome
					FROM
						publico_rsvp
					WHERE
						publico_id = ".$this->Db->qstr($w_id_evento_publico)."
					ORDER BY
						publico_id
					";
					 
      $nm_select = $sqlPub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspub = false;
          $rspub_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($rspub[0][0])) {									
						$w_publicoDsc = $rspub[0][1];
					} else {
						$w_publicoDsc = "";				
					}
				} else {
					$w_publicoDsc = "";		
				}
				if ($w_evento_regional  <> '0') {
					$sqlReg = "								
					SELECT
						regional_id,
						regional_dsc
					FROM
						tbl_regionais
					WHERE
						regional_id = ".$this->Db->qstr($w_evento_regional)."
					ORDER BY
						regional_id
					";					
					 
      $nm_select = $sqlReg; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsreg = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsreg[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsreg = false;
          $rsreg_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($rsreg[0][0])) {									
						$w_regionalDsc = $rsreg[0][1];
					} else {
						$w_regionalDsc = "";				
					}
				} else {
					$w_regionalDsc = "";
				}
				if ($w_id_hotel <> '0') {
					$sqlHot = "								
					SELECT
						hotel_id,
						hotel_fantasia
					FROM
						tbl_hoteis
					WHERE
						hotel_id = ".$this->Db->qstr($w_id_hotel)."
					ORDER BY
						hotel_id
					";
					 
      $nm_select = $sqlHot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rshot = false;
          $rshot_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($rshot[0][0])) {									
						$w_hotelDsc = $rshot[0][1];
					} else {
						$w_hotelDsc = "";				
					}	
				} else {
					$w_hotelDsc = "";	
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
      $rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsusu = false;
          $rsusu_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rsusu[0][0])) {									
					$w_usurelDsc = $rsusu[0][1];
				} else {
					$w_usurelDsc = "";				
				}		
				switch($w_tipo_transfer) {
					case 'A':
						$w_tipo_transfer = 'AEREO';  		  
						break;
					case 'L':
						$w_tipo_transfer = 'LOCAL'; 
						break;
					case 'P':
						$w_tipo_transfer = 'PROPRIO'; 
						break;									
				}
				switch($w_status) {
					case 'A':
						$w_status = 'ABERTO';  		 
						break;
					case 'Y':
						$w_status = 'SIM'; 
						break;
					case 'N':
						$w_status = 'NAO'; 
						break;		
					case 'P':
						$w_status = 'PENDENTE'; 
						break;		
				}
				$sqlEve = "								
				SELECT
					evento_id,
					evento_nome				
				FROM
					eventos_rsvp
				WHERE
					evento_id = ".$this->Db->qstr($w_id_evento)."
				ORDER BY
					evento_id
				";		
				 
      $nm_select = $sqlEve; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rseve = false;
          $rseve_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rseve[0][0])) {									
					$w_eventoDsc = $rseve[0][1];
				} else {
					$w_eventoDsc = "";				
				}		
				if ($vp_tipoPessoa == 'A') {										  
					$sqlPes = "								
					SELECT						
						pessoa_cpf,
						pessoa_nome				
					FROM
						pessoas_rsvp
					WHERE
						pessoa_cpf = ".$this->Db->qstr($w_cpf_particip)."
					ORDER BY
						pessoa_cpf
					";		
					 
      $nm_select = $sqlPes; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspes = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspes[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspes = false;
          $rspes_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($rspes[0][0])) {									
						$w_participante = $rspes[0][1];
					} else {
						$w_participante = "ERRO";				
					}							
				}	
				$sqlins = "
					SELECT 
						COUNT(cpf) as qtde
					FROM 
						trlocal_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($w_cpf_particip)." 
					AND 
						id_evento = ".$this->Db->qstr($w_id_evento)."									
					AND
						tipo_transfer = ".$this->Db->qstr($w_tipo_transfer)."
					AND 
						id_usuario_relato = ".$this->Db->qstr($vp_usuario)."	
				";
				 
      $nm_select = $sqlins; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rslins = false;
          $rslins_erro = $this->Db->ErrorMsg();
      } 

				if (isset($rslins[0][0])) {
					$qtde = $rslins[0][0];
				} else {
					$qtde = 0;
				}
				if ($qtde == 0) {													
					$sqli = "	
					INSERT INTO   
						trlocal_rsvp_r
						(id_evento,			
						participante,		
						data_nascimento,		
						rg,					
						cpf,					
						ddd_celular,			
						celular,				
						publico,				
						regional,			
						data_ida,			
						horario_ida,			
						origem_ida,			
						destino_ida,			
						data_volta,			
						horario_volta,		
						origem_volta,		
						destino_volta,		
						hotel,				
						tipo_pessoa,			
						status,				
						ativo,				
						id_usuario_relato,	
						observacoes,								
						usuario_relato_dsc,	
						publico_dsc,			
						regional_dsc,		
						hotel_dsc,			
						tipo_transfer,
						evento_dsc)		
					VALUES
						(".$this->Db->qstr($w_id_evento).", 		
						".$this->Db->qstr($w_participante).", 	
						".$this->Db->qstr($w_dt_nasc).", 		    
						".$this->Db->qstr($w_rg).",                
						".$this->Db->qstr($w_cpf_particip).",      
						".$this->Db->qstr($w_ddd_celular_01).",    
						".$this->Db->qstr($w_celeular_01).",       
						".$this->Db->qstr($w_id_evento_publico).", 
						".$this->Db->qstr($w_evento_regional).",   
						".$this->Db->qstr($w_dt_ida_local).",     
						".$this->Db->qstr($w_hr_ida_local).",      
						".$this->Db->qstr($w_origem_ida).",        
						".$this->Db->qstr($w_destino_ida).",       
						".$this->Db->qstr($w_dt_volta_local).",    
						".$this->Db->qstr($w_hr_volta_local).",    
						".$this->Db->qstr($w_origem_volta).",  	
						".$this->Db->qstr($w_destino_volta).",  	
						".$this->Db->qstr($w_id_hotel).",          
						".$this->Db->qstr($w_tipo_pessoa).",       
						".$this->Db->qstr($w_status).",            
						".$this->Db->qstr($w_ativo).",             
						".$this->Db->qstr($w_id_usuario_relato).", 
						".$this->Db->qstr($w_observacao).",        					 
						".$this->Db->qstr($w_usurelDsc).", 
						".$this->Db->qstr($w_publicoDsc).",  
						".$this->Db->qstr($w_regionalDsc).", 
						".$this->Db->qstr($w_hotelDsc).",  
						".$this->Db->qstr($w_tipo_transfer).",
						".$this->Db->qstr($w_eventoDsc).")					
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
					$sqlupd="
						UPDATE 
							trlocal_rsvp_r
						SET 
							id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
						WHERE 
							id_evento = ".$this->Db->qstr($vp_evento)."
					";
					 
      $nm_select = $sqlupd; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsupd = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsupd[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsupd = false;
          $rsupd_erro = $this->Db->ErrorMsg();
      } 
																							
				}	
				$ret = 'ADICIONA OK';
			}
		} else {
			if ($_passa_part == false) {				
				$ret = 'ADICIONA ERRO';
			} else {
				$ret = 'ADICIONA OK';
			}	
		}		
		return $ret;
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($rs[0][0]))
		$ret = $rs[0][0];
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}

}

?>
