<?php

class grid_rsvp_part_r_res_csv
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $array_titulos;
   var $array_linhas;

   var $Arquivo;
   var $Tit_doc;
   var $Delim_dados;
   var $Delim_line;
   var $Delim_col;
   var $sc_proc_grid; 

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("pt_br");
   }

   //---- 
   function monta_csv()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_res_grid']))
      {
          return;
      }
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Csv_f);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      else
      {
          $this->progress_bar_end();
      }
   }

   //----- 
   function inicializa_vars()
   {
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
      $this->array_titulos = array();
      $this->array_linhas  = array();
      $this->Csv_password  = "";
      $this->Arquivo       = "sc_csv";
      $this->Arquivo      .= "_" . date('YmdHis') . "_" . rand(0, 1000);
      $this->Arq_zip       = $this->Arquivo . "_grid_rsvp_part_r.zip";
      $this->Arquivo      .= "_grid_rsvp_part_r";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_res_grid']))
      {
          $this->Arquivo      .= "_" . $this->Ini->Nm_lang['lang_othr_smry_titl'];
      }
      $this->Arquivo      .= ".csv";
      $this->Tit_doc       = "grid_rsvp_part_r.csv";
      $this->Tit_zip       = "grid_rsvp_part_r.zip";
      $this->Label_CSV     = "N";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name'] .= ".csv";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_name']);
      }
      $this->Res           = new grid_rsvp_part_r_resumo("out");
      $this->prep_modulos("Res");
      $this->Delim_dados = "\"";
      $this->Delim_col   = ";";
      $this->Delim_line  = "\r\n";
      if (isset($_REQUEST['nm_delim_line']) && !empty($_REQUEST['nm_delim_line']))
      {
          $this->Delim_line = str_replace(array(1,2,3), array("\r\n","\r","\n"), $_REQUEST['nm_delim_line']);
      }
      if (isset($_REQUEST['nm_delim_col']) && !empty($_REQUEST['nm_delim_col']))
      {
          $this->Delim_col = str_replace(array(1,2,3,4,5), array(";",",","\	","#",""), $_REQUEST['nm_delim_col']);
      }
      if (isset($_REQUEST['nm_delim_dados']) && !empty($_REQUEST['nm_delim_dados']))
      {
          $this->Delim_dados = str_replace(array(1,2,3,4), array('"',"'","","|"), $_REQUEST['nm_delim_dados']);
      }
      if (isset($_REQUEST['nm_label_csv']) && !empty($_REQUEST['nm_label_csv']))
      {
          $this->Label_CSV = $_REQUEST['nm_label_csv'];
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_res_grid']) && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_rsvp_part_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_return']);
          $this->pb->setTotalSteps(100);
          $Mens_bar  = $this->Ini->Nm_lang['lang_othr_prcs'];
          $Mens_smry = $this->Ini->Nm_lang['lang_othr_smry_titl'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar  = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              $Mens_smry = sc_convert_encoding($Mens_smry, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
          $this->pb->addSteps(50);
      }
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //----- 
   function grava_arquivo()
   {
      $this->Csv_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      $csv_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      $this->Res->resumo_export();
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_res_grid']) && !$this->Ini->sc_export_ajax) {
          $Mens_bar  = $this->Ini->Nm_lang['lang_othr_prcs'];
          $Mens_smry = $this->Ini->Nm_lang['lang_othr_smry_titl'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar  = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              $Mens_smry = sc_convert_encoding($Mens_smry, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
          $this->pb->addSteps(30);
      }
      $this->array_titulos = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['arr_export']['label'];
      $this->array_linhas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['arr_export']['data'];
      $this->comp_y_axys  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['pivot_y_axys'];
      $this->comp_tabular = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['pivot_tabular'];
      if (1 >= sizeof($this->comp_y_axys))
      {
          $this->comp_tabular = false;
      }

        $this->csv_lines = [];

        if ('S' == $this->Label_CSV) {
            foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_rsvp_part_r'] ['export_info'] ['ordered_x_matrix'] as $rowNumber => $rowInfo) {
            }
        }

        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_rsvp_part_r'] ['export_data'] as $exportRowInfo) {
            $csvLine = [];

            $dimensionCount = 0;
            if ($exportRowInfo['row_total']) {
                $csvLine[] = $this->Delim_dados . str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $exportRowInfo['row_label']) . $this->Delim_dados;

                $dimensionCount++;
            } else {
                foreach ($exportRowInfo['row_parameters'] as $dimensionValue => $dimensionLabel) {
                    $dimensionLabel = str_replace("&nbsp;", "", $dimensionLabel);
                    if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($dimensionLabel)) {
                        $dimensionLabel = sc_convert_encoding($dimensionLabel, "UTF-8", $_SESSION['scriptcase']['charset']);
                    }
                    $dimensionLabel = $this->Delim_dados . str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $dimensionLabel) . $this->Delim_dados;

                    $csvLine[] = $dimensionLabel;

                    $dimensionCount++;
                }
            }

            for ($i = $dimensionCount; $i < $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_rsvp_part_r'] ['export_info'] ['dimension_count'] ['y']; $i++) {
                $csvLine[] = $this->Delim_dados . $this->Delim_dados;
            }

            foreach ($exportRowInfo['column_list'] as $exportColumnInfo) {
                $csvLine[] = $this->Delim_dados . $exportColumnInfo['metric_value'] . $this->Delim_dados;
            }

            $this->csv_lines[] = implode($this->Delim_col, $csvLine);
        }

        fwrite($csv_f, implode($this->Delim_line, $this->csv_lines));
        fclose($csv_f);
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_res_grid']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_res_file'] = $this->Csv_f;
      }
      elseif ($this->Csv_password != "")
      { 
          $str_zip = "";
          $Zip_f = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
          $Arq_input   = (FALSE !== strpos($this->Csv_f, ' ')) ? " \"" . $this->Csv_f . "\"" :  $this->Csv_f;
          if (is_file($Zip_f)) {
              unlink($Zip_f);
          }
          if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
          {
              chdir($this->Ini->path_third . "/zip/windows");
              $str_zip = "zip.exe -P -j " . $this->Csv_password . " " . $Zip_f . " " . $Arq_input;
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
              $str_zip = "./7za -p" . $this->Csv_password . " a " . $Zip_f . " " . $Arq_input;
          }
          elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
          {
              chdir($this->Ini->path_third . "/zip/mac/bin");
             $str_zip = "./7za -p" . $this->Csv_password . " a " . $Zip_f . " " . $Arq_input;
          }
          if (!empty($str_zip)) {
              exec($str_zip);
          }
          unlink($Arq_input);
          $this->Arquivo = $this->Arq_zip;
          $this->Csv_f   = $this->Zip_f;
          $this->Tit_doc = $this->Tit_zip;
          // ----- ZIP log
          $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
          if ($fp)
          {
              @fwrite($fp, $str_zip . "\r\n\r\n");
              @fclose($fp);
          }
      } 
   }

   function grava_titulos($csv_f)
   {
      $b_display = false;
      $contr_rowspan = array();
      $contr_colspan = array();
      foreach ($this->array_titulos as $lines)
      {
           $csv_registro = "";
           $col = 0;
           if (!$b_display)
           {
               $colspan = $this->comp_tabular ? sizeof($this->comp_y_axys) : 1;
               $contr_rowspan[$col] = sizeof($this->array_titulos);
               $contr_colspan[$col] = $colspan;
               $campo_titulo = $this->Ini->Nm_lang['lang_othr_smry_msge'];
               if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($campo_titulo))
               {
                   $campo_titulo = sc_convert_encoding($campo_titulo, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $csv_registro .= $this->Delim_dados . str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $campo_titulo) . $this->Delim_dados;
               if ($colspan > 1)
               {
                   for ($x = 1; $x < $colspan; $x++)
                   {
                       $csv_registro .= $this->Delim_col . $this->Delim_dados . $this->Delim_dados;
                   }
               }
               $b_display = true;
               $col += $colspan;
           }
           foreach ($lines as $columns)
           {
               $col_ok = false;
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? $columns['colspan'] : 1;
               while (!$col_ok)
               {
                   $prim = true;
                   if (isset($contr_rowspan[$col]) && 1 < $contr_rowspan[$col])
                   {
                       $contr_rowspan[$col]--;
                       $col_sp = $contr_colspan[$col];
                       for ($x = 0; $x < $col_sp; $x++)
                       {
                           if (!$prim)
                           {
                               $csv_registro .= $this->Delim_col;
                           }
                           $csv_registro .= $this->Delim_dados . $this->Delim_dados;
                           $col ++;
                           $prim = false;
                       }
                   }
                   else
                   {
                       $col_ok = true;
                   }
               }
               if (isset($columns['rowspan']) && 1 < $columns['rowspan'])
               {
                   $contr_rowspan[$col] = $columns['rowspan'];
                   $contr_colspan[$col] = $colspan;
               }
               $campo_titulo = $columns['label'];
               if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($campo_titulo))
               {
                   $campo_titulo = sc_convert_encoding($campo_titulo, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $csv_registro .= $this->Delim_col . $this->Delim_dados . str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $campo_titulo) . $this->Delim_dados;
               if ($colspan > 1)
               {
                   for ($x = 1; $x < $colspan; $x++)
                   {
                       $csv_registro .= $this->Delim_col . $this->Delim_dados . $this->Delim_dados;
                   }
               }
               $col += $colspan;
           }
           foreach ($contr_rowspan as $col_t => $row)
           {
               if ($col_t >= $col && $row > 1)
               {
                   $contr_rowspan[$col]--;
               }
           }
           $csv_registro .= $this->Delim_line;
           fwrite($csv_f, $csv_registro);
      }
   }
   function grava_linha($csv_f, $lines)
   {
       $csv_registro = "";
       $prim = true;
       $col     = 0;
       $colspan = 0;
       foreach ($lines as $ind => $columns)
       {
           $col = $ind + $colspan;
           if (isset($columns['colspan']) && $columns['colspan'] > 0)
           {
              $colspan = $columns['colspan'] - 1;
           }
           if (0 <= $columns['level'])
           {
              $cada_dado = $columns['label'];
           }
           else
           {
               $cada_dado = $columns['value'];
           }
           if (is_array($cada_dado)) {
               $cada_dado = "";
           }
           $cada_dado = str_replace("&nbsp;", "", $cada_dado);
           if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($cada_dado))
           {
               $cada_dado = sc_convert_encoding($cada_dado, "UTF-8", $_SESSION['scriptcase']['charset']);
           }
           $cada_dado = $this->Delim_dados . str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $cada_dado) . $this->Delim_dados;
           if ($prim)
           {
               for ($x = ($ind + 1); $x < count($this->control_lines); $x++)
               {
                   $this->control_lines[$x] = $this->Delim_dados . $this->Delim_dados;
               }
               $prim = false;
           }
           $this->control_lines[$col] = $cada_dado;
       }
       $csv_registro = implode($this->Delim_col, $this->control_lines) . $this->Delim_line;
       fwrite($csv_f, $csv_registro);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Relatório RSVP :: CSV</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Pragma" content="no-cache">
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
   <td class="scExportTitle" style="height: 25px">CSV</td>
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
<form name="Fdown" method="get" action="grid_rsvp_part_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_rsvp_part_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['csv_return']); ?>"> 
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

function BuscaAcomp($evento,$usuario,$ptipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		
		$valor_y = 'Y';
		$sqlj="
			SELECT
				participantes_rsvp.part_cpf AS p_cpf,
				participantes_rsvp.part_id_evento AS p_evento,
				acompanhantes_rsvp.part_id_evento AS ac_evento,
				acompanhantes_rsvp.part_cpf_mestre AS ac_cpf_mestre ,
				acompanhantes_rsvp.part_cpf AS ac_cpf,
				pessoas_rsvp.pessoa_cpf AS pe_cpf,
				pessoas_rsvp.pessoa_nome AS pe_nome
			FROM
				participantes_rsvp
			LEFT JOIN 
				acompanhantes_rsvp
			ON 
				acompanhantes_rsvp.part_cpf_mestre = participantes_rsvp.part_cpf  
			LEFT JOIN 
				pessoas_rsvp
			ON 
				pessoas_rsvp.pessoa_cpf = acompanhantes_rsvp.part_cpf		
			WHERE
				participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."
			AND 
				acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."			
			AND 
				acompanhantes_rsvp.part_cpf_mestre IS NOT NULL	
			ORDER BY
				participantes_rsvp.part_cpf			
		";	
		 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsj = false;
          $rsj_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_part = sizeof($rsj );
		$v_nome_acompanhante = '';
		$_contador = 1;
		$_atucpf = '';
		if ($reg_part > 0) {
			for ($i=0;$i<$reg_part;++$i) {
				$_antcpf = $rsj[$i][0];
				if($_antcpf <> $_atucpf) {
					$v_nome_acompanhante = '';	
					$_contador = 1;
				}	
				$v_cpf_participante = $rsj[$i][0];
				
				if ($_contador == 1) {
					$v_nome_acompanhante = $rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
							rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;
					}	
				} else {
					$v_nome_acompanhante = $v_nome_acompanhante.';'.$rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
								rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;		
					}
				}
				
     $nm_select = $sqlu; 
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

				$_atucpf = $rsj[$i][0];
				$_contador = $_contador + 1;
			}			
		}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp($evento,$usuario,$nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  		
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		$nome_empresa = '';
	
		if($nivel == 'CONVIDADO') {
			$sqlconv = "
				SELECT
					evento_id,
					usuario_id,
					nome_empresa
				FROM
					eventos_usuarios_rsvp			
				WHERE	
					evento_id = ".$this->Db->qstr($evento)."
				AND 
					usuario_id = ".$this->Db->qstr($usuario)."	
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
	
		
		$sqld="
		DELETE FROM 
			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
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

		
		$sql="
		SELECT
    		p_evento,
  			id_usuario_relato
		FROM
   			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
		ORDER BY 
			p_evento,
  			id_usuario_relato
		";	
		 
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
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_subs = sizeof($rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {
			if($nome_empresa == '') {
				$sqlj="				
				SELECT
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional, 
					participantes_rsvp.part_grupo AS p_grupo,
					participantes_rsvp.part_departamento AS p_departamento,	
					participantes_rsvp.part_cargo AS p_cargo,
					participantes_rsvp.part_tam_camisa AS p_tam_camisa,
					participantes_rsvp.part_idioma AS p_idioma,
					participantes_rsvp.part_empresa AS p_empresa,
					participantes_rsvp.part_uf AS p_uf,
					participantes_rsvp.part_pais AS p_pais,
					participantes_rsvp.part_email AS p_email,
					participantes_rsvp.part_email_secretaria AS p_email_secretaria,
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
					participantes_rsvp.part_celeular_01 AS p_celular_01,
					participantes_rsvp.part_ddd_01 AS p_ddd_01,         
					participantes_rsvp.part_fone_01 AS p_fone_01,       
					participantes_rsvp.nome_pessoa AS p_nome,           
					participantes_rsvp.part_cpf AS p_cpf,               
					participantes_rsvp.part_id_evento,                  
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional					
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
				";
							
			} else {
				$sqlj="				
				SELECT
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional, 
					participantes_rsvp.part_grupo AS p_grupo,
					participantes_rsvp.part_departamento AS p_departamento,	
					participantes_rsvp.part_cargo AS p_cargo,
					participantes_rsvp.part_tam_camisa AS p_tam_camisa,
					participantes_rsvp.part_idioma AS p_idioma,
					participantes_rsvp.part_empresa AS p_empresa,
					participantes_rsvp.part_uf AS p_uf,
					participantes_rsvp.part_pais AS p_pais,
					participantes_rsvp.part_email AS p_email,
					participantes_rsvp.part_email_secretaria AS p_email_secretaria,
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
					participantes_rsvp.part_celeular_01 AS p_celular_01,
					participantes_rsvp.part_ddd_01 AS p_ddd_01,         
					participantes_rsvp.part_fone_01 AS p_fone_01,       
					participantes_rsvp.nome_pessoa AS p_nome,           
					participantes_rsvp.part_cpf AS p_cpf,               
					participantes_rsvp.part_id_evento,                  
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."	
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
				";
			}
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsj = false;
          $rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $rsj[$i][0];   
					$vpregional					= $rsj[$i][1];   
					$vpgrupo 					= $rsj[$i][2];	  
					$vpdepartamento 			= $rsj[$i][3];	    
					$vpcargo 					= $rsj[$i][4];   
					$vptam_camisa           	= $rsj[$i][5];   
					$vpidioma               	= $rsj[$i][6];   
					$vpempresa              	= $rsj[$i][7];   
					$vpuf                   	= $rsj[$i][8];   
					$vppais                 	= $rsj[$i][9];   
					$vpemail                	= $rsj[$i][10];  
					$vpemail_secretaria     	= $rsj[$i][11];  
					$vpddd_celular_01       	= $rsj[$i][12];    
					$vpcelular_01           	= $rsj[$i][13];  
					$vpddd_01               	= $rsj[$i][14];  
					$vpfone_01              	= $rsj[$i][15];  
					$vpnome                 	= $rsj[$i][16];  
					$vpcpf                  	= $rsj[$i][17];  
					$vpevento               	= $rsj[$i][18];  
					$vpublico_nome				= $rsj[$i][19];
					$vregional_nome				= $rsj[$i][20];  
					
					$vdtnasc					= $rsj[$i][21];  
					$vrg						= $rsj[$i][22]; 
					$vpartcpf					= $rsj[$i][23]; 
					$vanotacoes					= $rsj[$i][24]; 
					$vfoneinter					= $rsj[$i][25]; 	
										
					$vcontato_cpf            	= '';  
					$vcontato_status         	= '';  
					$vcontato_data           	= ''; 
					$vcontato_motivo         	= '';
					$vcontato_obs            	= '';
					$vcontato_usuario_id        = '';
					$vcontato_status_dsc        = ''; 

					$vpresenca_tipo_part        = '';
					$vpresenca_status        	= '';
					$vpresenca_obs           	= '';
					$vpresenca_motivo        	= '';  
					$vpresenca_data				= '';  
					$vpresenca_usuario_id       = '';  
					$vcontato_usuario_nome		= '';  
					$vpresenca_usuario_nome		= '';  			
					$vpresenca_cpf				= '';
					$vpresenca_status_dsc		= ''; 
					
					$vusuario_relato_nome		= ''; 
					$vusuario_relato_dsc		= ''; 
					$vacompanhantes_nomes		= ''; 

					$vhospedagem_cpf           	= '';
					$vhospedagem_evento        	= '';
					$vhospedagem_id_hotel      	= '';
					$vhospedagem_dtchkin       	= '';
					$vhospedagem_hrchkin       	= '';
					$vhospedagem_dtchkout      	= '';
					$vhospedagem_hrchkout      	= '';
					$vhospedagem_acompanhante  	= '';
					$vhospedagem_tipo_pessoa   	= '';
					$vhotel_fantasia           	= '';
					$vid_usuario_relato_id		= $this->sc_temp_vg_usuario_id;
					
					if($vpartcpf == '') {
						$vpartcpf = $vpcpf;
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
						contatos_rsvp.contato_cpf_participante = '".$vpcpf."'                                                                                 
					AND
						contatos_rsvp.contato_id_evento = '".$vpevento."'
					ORDER BY                                                                                                        
						contatos_rsvp.contato_data_hora DESC,
						contato_id_evento,
						contato_cpf_participante
					LIMIT 1						
					";
					 
      $nm_select = $sqlcont; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rscont = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscont[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscont = false;
          $rscont_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rscont[0][0])) {					
						$vcontato_cpf 			= $rscont[0][0];			
						$vcontato_status        = $rscont[0][2];   
						$vcontato_data          = $rscont[0][3];  
						$vcontato_motivo        = $rscont[0][4]; 
						$vcontato_obs           = $rscont[0][5]; 
						$vcontato_usuario_id    = $rscont[0][6];   
						$vcontato_usuario_nome	= $rscont[0][7];						
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
					} else {
						$vcontato_status_dsc = 'ABERTO'; 	
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
						presencas_rsvp.presenca_cpf_participante = ".$this->Db->qstr($vpcpf)."                                                                                 
					AND
						presencas_rsvp.presenca_id_evento = ".$this->Db->qstr($vpevento)."
					ORDER BY                                                                                                        
						presencas_rsvp.presenca_data_hora DESC,
						presencas_rsvp.presenca_id_evento,
						presencas_rsvp.presenca_cpf_participante
					LIMIT 1											
					";
					 
      $nm_select = $sqlpres; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspres = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspres[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspres = false;
          $rspres_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspres[0][0])) {											
						$vpresenca_status       = $rspres[0][2];
						$vpresenca_data			= $rspres[0][3];  
						$vpresenca_motivo       = $rspres[0][4];  
						$vpresenca_obs          = $rspres[0][5];
						$vpresenca_usuario_id   = $rspres[0][6];  
						$vpresenca_tipo_part    = $rspres[0][7];
						$vpresenca_usuario_nome	= $rspres[0][8];								
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
					$sqlins = "
						SELECT 
							COUNT(p_cpf) as qtde
						FROM 
							rsvp_part_r
						WHERE 
							p_cpf = ".$this->Db->qstr($vpcpf)." 
						AND 
							p_evento = ".$this->Db->qstr($vpevento)."		
						AND 
    						id_usuario_relato = ".$this->Db->qstr($usuario)."	
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
						$sqli="					
						INSERT INTO   
							rsvp_part_r  
							(p_publico, 						
							p_regional,				    
							p_grupo, 				    
							p_departamento, 		    
							p_cargo, 				    
							p_tam_camisa,               
							p_idioma,                   
							p_empresa,                  
							p_uf,                       
							p_pais,                     
							p_email,                    
							p_email_secretaria,         
							p_ddd_celular_01,           
							p_celular_01,               
							p_ddd_01,                   
							p_fone_01,                  
							p_nome,                     
							p_cpf,                      
							p_evento,                   
							contato_cpf,                
							contato_status,             
							contato_data,               
							contato_motivo,             
							contato_obs,                
							presenca_tipo_part,         
							presenca_status,            
							presenca_obs,               
							presenca_motivo,            
							hospedagem_cpf,             
							hospedagem_evento,          
							hospedagem_id_hotel,        
							hospedagem_dtchkin,         
							hospedagem_hrchkin,         
							hospedagem_dtchkout,        
							hospedagem_hrchkout,        
							hospedagem_acompanhante,    
							hospedagem_tipo_pessoa,     
							hotel_fantasia,             
							publico_nome,               
							regional_nome,              
							id_usuario_relato, 		    
							contato_status_dsc,         
							presenca_status_dsc,        
							contato_usuario_id,         
							contato_usuario_nome,       
							presenca_data,
							presenca_usuario_id,
							presenca_usuario_dsc,
							data_nascimento,
							rg,
							cpf_informado,
							anotacoes,
							telefone_internacional)	             
						VALUES
							(".$this->Db->qstr($vppublico).",	
							".$this->Db->qstr($vpregional).",	
							".$this->Db->qstr($vpgrupo).",	
							".$this->Db->qstr($vpdepartamento).",
							".$this->Db->qstr($vpcargo).",
							".$this->Db->qstr($vptam_camisa).",
							".$this->Db->qstr($vpidioma).",
							".$this->Db->qstr($vpempresa).",
							".$this->Db->qstr($vpuf).",
							".$this->Db->qstr($vppais).",
							".$this->Db->qstr($vpemail).",
							".$this->Db->qstr($vpemail_secretaria).",
							".$this->Db->qstr($vpddd_celular_01).",
							".$this->Db->qstr($vpcelular_01).",
							".$this->Db->qstr($vpddd_01).",
							".$this->Db->qstr($vpfone_01).",
							".$this->Db->qstr($vpnome).",
							".$this->Db->qstr($vpcpf).",
							".$this->Db->qstr($vpevento).",
							".$this->Db->qstr($vcontato_cpf).",
							".$this->Db->qstr($vcontato_status).",
							".$this->Db->qstr($vcontato_data).",
							".$this->Db->qstr($vcontato_motivo).",
							".$this->Db->qstr($vcontato_obs).",
							".$this->Db->qstr($vpresenca_tipo_part).",
							".$this->Db->qstr($vpresenca_status).",
							".$this->Db->qstr($vpresenca_obs).",
							".$this->Db->qstr($vpresenca_motivo).",
							".$this->Db->qstr($vhospedagem_cpf).",
							".$this->Db->qstr($vhospedagem_evento).",
							".$this->Db->qstr($vhospedagem_id_hotel).",
							".$this->Db->qstr($vhospedagem_dtchkin).",
							".$this->Db->qstr($vhospedagem_hrchkin).",
							".$this->Db->qstr($vhospedagem_dtchkout).",
							".$this->Db->qstr($vhospedagem_hrchkout).",
							".$this->Db->qstr($vhospedagem_acompanhante).",
							".$this->Db->qstr($vhospedagem_tipo_pessoa).",
							".$this->Db->qstr($vhotel_fantasia).",
							".$this->Db->qstr($vpublico_nome).",
							".$this->Db->qstr($vregional_nome).",
							".$this->Db->qstr($vid_usuario_relato_id).",
							".$this->Db->qstr($vcontato_status_dsc).",
							".$this->Db->qstr($vpresenca_status_dsc).",
							".$this->Db->qstr($vcontato_usuario_id).",
							".$this->Db->qstr($vcontato_usuario_nome).",															
							".$this->Db->qstr($vpresenca_data).",
							".$this->Db->qstr($vpresenca_usuario_id).",
							".$this->Db->qstr($vpresenca_usuario_nome).",
							".$this->Db->qstr($vdtnasc).",
							".$this->Db->qstr($vrg).",
							".$this->Db->qstr($vpartcpf).",							
							".$this->Db->qstr($vanotacoes).",
							".$this->Db->qstr($vfoneinter).")
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
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp2($evento,$usuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		
		
		$sqld="
		DELETE FROM 
			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
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

		
		
		$sql="
		SELECT
    		p_evento,
  			id_usuario_relato
		FROM
   			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
		ORDER BY 
			p_evento,
  			id_usuario_relato
		";	
		 
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
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_subs = sizeof($rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {	
			$sqlj="	
			SELECT
				participantes_rsvp.part_id_evento_publico AS p_publico,
				participantes_rsvp.part_id_evento_regional AS p_regional, 
				participantes_rsvp.part_grupo AS p_grupo,
				participantes_rsvp.part_departamento AS p_departamento,	
				participantes_rsvp.part_cargo AS p_cargo,
				participantes_rsvp.part_tam_camisa AS p_tam_camisa,
				participantes_rsvp.part_idioma AS p_idioma,
				participantes_rsvp.part_empresa AS p_empresa,
				participantes_rsvp.part_uf AS p_uf,
				participantes_rsvp.part_pais AS p_pais,
				participantes_rsvp.part_email AS p_email,
				participantes_rsvp.part_email_secretaria AS p_email_secretaria,
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
				participantes_rsvp.part_celeular_01 AS p_celular_01,
				participantes_rsvp.part_ddd_01 AS p_ddd_01,         
				participantes_rsvp.part_fone_01 AS p_fone_01,       
				participantes_rsvp.nome_pessoa AS p_nome,           
				participantes_rsvp.part_cpf AS p_cpf,               
				participantes_rsvp.part_id_evento,                  
				contatos_rsvp.contato_cpf_participante AS contato_cpf,
				contatos_rsvp.contato_status AS contato_status,       
				contatos_rsvp.contato_data_hora AS contato_data,      
				contatos_rsvp.contato_motivo_frase AS contato_motivo, 
				contatos_rsvp.contato_obs AS contato_obs,             
				contatos_rsvp.contato_usuario_id,
				presencas_rsvp.presenca_tipo_part AS presenca_tipo_part,
				presencas_rsvp.presenca_status AS presenca_status,	
				presencas_rsvp.presenca_obs AS presenca_obs,
				presencas_rsvp.presenca__frase_resposta AS presenca_motivo,
				presencas_rsvp.presenca_data_hora, 
				presencas_rsvp.presenca_usuario_id,
				usuarios_rsvp.usuario_nome AS usuario_contato,
				usuarios_rsvp.usuario_nome AS usuario_presenca,
				publico_rsvp.publico_nome,
				tbl_regionais.regional_dsc
			FROM
				participantes_rsvp
			LEFT JOIN 
				contatos_rsvp 
			ON 
				participantes_rsvp.part_cpf  = contatos_rsvp.contato_cpf_participante
			LEFT JOIN 
				presencas_rsvp
			ON 
				participantes_rsvp.part_cpf = presencas_rsvp.presenca_cpf_participante
			LEFT JOIN
				publico_rsvp
			ON 
				publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
			LEFT JOIN
				tbl_regionais
			ON
				tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional
			LEFT JOIN
				usuarios_rsvp
			ON
				usuarios_rsvp.usuario_id = contatos_rsvp.contato_usuario_id	
			AND 	
				usuarios_rsvp.usuario_id = presencas_rsvp.presenca_usuario_id		
			WHERE
				participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
			AND
				participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
			GROUP by
				participantes_rsvp.part_cpf		
			ORDER BY				 
				participantes_rsvp.nome_pessoa,
				contatos_rsvp.contato_data_hora DESC,
				presencas_rsvp.presenca_data_hora DESC 		
			";		
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsj = false;
          $rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $rsj[$i][0];   
					$vpregional					= $rsj[$i][1];   
					$vpgrupo 					= $rsj[$i][2];	  
					$vpdepartamento 			= $rsj[$i][3];	  
					$vpcargo 					= $rsj[$i][4];   
					$vptam_camisa           	= $rsj[$i][5];   
					$vpidioma               	= $rsj[$i][6];   
					$vpempresa              	= $rsj[$i][7];   
					$vpuf                   	= $rsj[$i][8];   
					$vppais                 	= $rsj[$i][9];   
					$vpemail                	= $rsj[$i][10];  
					$vpemail_secretaria     	= $rsj[$i][11];  
					$vpddd_celular_01       	= $rsj[$i][12];  
					$vpcelular_01           	= $rsj[$i][13];  
					$vpddd_01               	= $rsj[$i][14];  
					$vpfone_01              	= $rsj[$i][15];  
					$vpnome                 	= $rsj[$i][16];  
					$vpcpf                  	= $rsj[$i][17];  
					$vpevento               	= $rsj[$i][18];  
					$vcontato_cpf            	= $rsj[$i][19];  
					$vcontato_status         	= $rsj[$i][20];  
					$vcontato_data           	= $rsj[$i][21]; 
					$vcontato_motivo         	= $rsj[$i][22];
					$vcontato_obs            	= $rsj[$i][23];
					$vcontato_usuario_id        = $rsj[$i][24];
					$vpresenca_tipo_part        = $rsj[$i][25];
					$vpresenca_status        	= $rsj[$i][26];
					$vpresenca_obs           	= $rsj[$i][27];
					$vpresenca_motivo        	= $rsj[$i][28];  
					$vpresenca_data				= $rsj[$i][29];  
					$vpresenca_usuario_id       = $rsj[$i][30];  
					$vcontato_usuario_nome		= $rsj[$i][31];  
					$vpresenca_usuario_nome		= $rsj[$i][32];  
					$vpublico_nome				= $rsj[$i][33];  
					$vregional_nome				= $rsj[$i][34];  

					$vcontato_status_dsc        = ''; 
					$vpresenca_status_dsc		= ''; 
					$vusuario_relato_nome		= ''; 
					$vusuario_relato_dsc		= ''; 
					$vacompanhantes_nomes		= ''; 

					$vhospedagem_cpf           	= '';
					$vhospedagem_evento        	= '';
					$vhospedagem_id_hotel      	= '';
					$vhospedagem_dtchkin       	= '';
					$vhospedagem_hrchkin       	= '';
					$vhospedagem_dtchkout      	= '';
					$vhospedagem_hrchkout      	= '';
					$vhospedagem_acompanhante  	= '';
					$vhospedagem_tipo_pessoa   	= '';
					$vhotel_fantasia           	= '';
					$vid_usuario_relato_id		= $this->sc_temp_vg_usuario_id;
							
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
					if ($vcontato_cpf == '') {
						$vcontato_status_dsc = 'ABERTO'; 	
					}
					
					$sqli="					
					INSERT INTO   
						rsvp_part_r  
						(p_publico, 						
						p_regional,				    
						p_grupo, 				    
						p_departamento, 		    
						p_cargo, 				    
						p_tam_camisa,               
						p_idioma,                   
						p_empresa,                  
						p_uf,                       
						p_pais,                     
						p_email,                    
						p_email_secretaria,         
						p_ddd_celular_01,           
						p_celular_01,               
						p_ddd_01,                   
						p_fone_01,                  
						p_nome,                     
						p_cpf,                      
						p_evento,                   
						contato_cpf,                
						contato_status,             
						contato_data,               
						contato_motivo,             
						contato_obs,                
						presenca_tipo_part,         
						presenca_status,            
						presenca_obs,               
						presenca_motivo,            
						hospedagem_cpf,             
						hospedagem_evento,          
						hospedagem_id_hotel,        
						hospedagem_dtchkin,         
						hospedagem_hrchkin,         
						hospedagem_dtchkout,        
						hospedagem_hrchkout,        
						hospedagem_acompanhante,    
						hospedagem_tipo_pessoa,     
						hotel_fantasia,             
						publico_nome,               
						regional_nome,              
						id_usuario_relato, 		    
						contato_status_dsc,         
						presenca_status_dsc,        
						contato_usuario_id,         
						contato_usuario_nome,       
						presenca_data,
						presenca_usuario_id,
						presenca_usuario_dsc)	             
					VALUES
						(".$this->Db->qstr($vppublico).",	
						".$this->Db->qstr($vpregional).",	
						".$this->Db->qstr($vpgrupo).",	
						".$this->Db->qstr($vpdepartamento).",
						".$this->Db->qstr($vpcargo).",
						".$this->Db->qstr($vptam_camisa).",
						".$this->Db->qstr($vpidioma).",
						".$this->Db->qstr($vpempresa).",
						".$this->Db->qstr($vpuf).",
						".$this->Db->qstr($vppais).",
						".$this->Db->qstr($vpemail).",
						".$this->Db->qstr($vpemail_secretaria).",
						".$this->Db->qstr($vpddd_celular_01).",
						".$this->Db->qstr($vpcelular_01).",
						".$this->Db->qstr($vpddd_01).",
						".$this->Db->qstr($vpfone_01).",
						".$this->Db->qstr($vpnome).",
						".$this->Db->qstr($vpcpf).",
						".$this->Db->qstr($vpevento).",
						".$this->Db->qstr($vcontato_cpf).",
						".$this->Db->qstr($vcontato_status).",
						".$this->Db->qstr($vcontato_data).",
						".$this->Db->qstr($vcontato_motivo).",
						".$this->Db->qstr($vcontato_obs).",
						".$this->Db->qstr($vpresenca_tipo_part).",
						".$this->Db->qstr($vpresenca_status).",
						".$this->Db->qstr($vpresenca_obs).",
						".$this->Db->qstr($vpresenca_motivo).",
						".$this->Db->qstr($vhospedagem_cpf).",
						".$this->Db->qstr($vhospedagem_evento).",
						".$this->Db->qstr($vhospedagem_id_hotel).",
						".$this->Db->qstr($vhospedagem_dtchkin).",
						".$this->Db->qstr($vhospedagem_hrchkin).",
						".$this->Db->qstr($vhospedagem_dtchkout).",
						".$this->Db->qstr($vhospedagem_hrchkout).",
						".$this->Db->qstr($vhospedagem_acompanhante).",
						".$this->Db->qstr($vhospedagem_tipo_pessoa).",
						".$this->Db->qstr($vhotel_fantasia).",
						".$this->Db->qstr($vpublico_nome).",
						".$this->Db->qstr($vregional_nome).",
						".$this->Db->qstr($vid_usuario_relato_id).",
						".$this->Db->qstr($vcontato_status_dsc).",
						".$this->Db->qstr($vpresenca_status_dsc).",
						".$this->Db->qstr($vcontato_usuario_id).",
						".$this->Db->qstr($vcontato_usuario_nome).",
						".$this->Db->qstr($vpresenca_data).",
						".$this->Db->qstr($vpresenca_usuario_id).",
						".$this->Db->qstr($vpresenca_usuario_nome).")
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

				}
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}

}

?>
