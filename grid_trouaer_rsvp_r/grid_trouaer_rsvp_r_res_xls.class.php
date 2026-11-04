<?php

class grid_trouaer_rsvp_r_res_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Xls_dados;
   var $Xls_workbook;
   var $Xls_col;
   var $Xls_row;
   var $array_titulos;
   var $array_linhas;
   var $Arquivo;
   var $Tit_doc;

   //---- 
   function __construct()
   {
   }

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_res_grid']))
      {
          return;
      }
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xls_f);
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
      $this->Use_phpspreadsheet = (phpversion() >=  "7.3.9" && is_dir($this->Ini->path_third . '/phpspreadsheet')) ? true : false;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
      $this->Xls_row = 1;
      if ($this->Use_phpspreadsheet) {
          require_once $this->Ini->path_third . '/phpspreadsheet/vendor/autoload.php';
      } 
      else { 
          set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
      } 
      $this->array_titulos = array();
      $this->array_linhas  = array();
      $this->Xls_password = "";
      $this->Xls_tp     = ".xlsx";
      $this->Xls_col    = 0;
      $this->nm_data    = new nm_data("pt_br");
      if (isset($_REQUEST['nmgp_tp_xls']) && !empty($_REQUEST['nmgp_tp_xls']))
      {
          $this->Xls_tp = "." . $_REQUEST['nmgp_tp_xls'];
      }
      $this->Arquivo    = "sc_xls";
      $this->Arquivo   .= "_" . date('YmdHis') . "_" . rand(0, 1000);
      $this->Arq_zip    = $this->Arquivo . "_grid_trouaer_rsvp_r.zip";
      $this->Arquivo   .= "_grid_trouaer_rsvp_r";
      $this->Arquivo   .= $this->Xls_tp;
      $this->Tit_doc    = "grid_trouaer_rsvp_r" . $this->Xls_tp;
      $this->Tit_zip    = "grid_trouaer_rsvp_r.zip";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name'] .= $this->Xls_tp ;
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_name']);
      }
      $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      if ($this->Use_phpspreadsheet) {
          $this->Xls_dados = new PhpOffice\PhpSpreadsheet\Spreadsheet();
      }
      else {
          $this->Xls_dados = new PHPExcel();
      }
      $this->Xls_dados->setActiveSheetIndex(0);
      $this->Nm_ActiveSheet = $this->Xls_dados->getActiveSheet();
      $this->Nm_ActiveSheet->setTitle($this->Ini->Nm_lang['lang_othr_smry_titl']);
      if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
      {
          $this->Nm_ActiveSheet->setRightToLeft(true);
      }
      $this->Res       = new grid_trouaer_rsvp_r_resumo("out");
      $this->prep_modulos("Res");
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_res_grid']) && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_trouaer_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_return']);
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
      $this->Res->resumo_export();
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_res_grid']) && !$this->Ini->sc_export_ajax) {
          $Mens_bar  = $this->Ini->Nm_lang['lang_othr_prcs'];
          $Mens_smry = $this->Ini->Nm_lang['lang_othr_smry_titl'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar  = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              $Mens_smry = sc_convert_encoding($Mens_smry, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
          $this->pb->addSteps(30);
      }
      $this->comp_field   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['pivot_group_by'];
      $this->comp_y_axys  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['pivot_y_axys'];
      $this->comp_tabular = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['pivot_tabular'];
      $this->array_titulos = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['arr_export']['label'];
      $this->array_linhas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['arr_export']['data'];
      $b_display = false;
      $contr_rowspan = array();
      $contr_colspan = array();
      foreach ($this->array_titulos as $lines)
      {
           $this->Xls_col = 0;
           if (!$b_display)
           {
               if ($this->comp_tabular)
               {
                   foreach ($this->comp_y_axys as $iYAxysIndex)
                   {
                       $contr_rowspan[$this->Xls_col] = sizeof($this->array_titulos);
                       $contr_colspan[$this->Xls_col] = 1;
                       if ($this->Use_phpspreadsheet) {
                           $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                       }
                       else {
                           $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                       }
                       $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->comp_field[$iYAxysIndex]);
                       $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
                       $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
                       $this->Xls_col += 1;
                   }
               }
               else
               {
                   $colspan = $this->comp_tabular ? sizeof($this->comp_y_axys) : 1;
                   $contr_rowspan[$this->Xls_col] = sizeof($this->array_titulos);
                   $contr_colspan[$this->Xls_col] = $colspan;
                   $campo_titulo = $this->Ini->Nm_lang['lang_othr_smry_msge'];
                   if (!NM_is_utf8($campo_titulo))
                   {
                       $campo_titulo = sc_convert_encoding($campo_titulo, "UTF-8", $_SESSION['scriptcase']['charset']);
                   }
                   if ($this->Use_phpspreadsheet) {
                       $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   }
                   $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $campo_titulo);
                   $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
                   $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
                   $this->Xls_col += $colspan;
               }
               $b_display = true;
           }
           foreach ($lines as $columns)
           {
               $col_ok = false;
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? $columns['colspan'] : 1;
               while (!$col_ok)
               {
                   if (isset($contr_rowspan[$this->Xls_col]) && 1 < $contr_rowspan[$this->Xls_col])
                   {
                       $contr_rowspan[$this->Xls_col]--;
                       $this->Xls_col += $contr_colspan[$this->Xls_col];
                   }
                   else
                   {
                       $col_ok = true;
                   }
               }
               if (isset($columns['rowspan']) && 1 < $columns['rowspan'])
               {
                   $contr_rowspan[$this->Xls_col] = $columns['rowspan'];
                   $contr_colspan[$this->Xls_col] = $colspan;
               }
               $campo_titulo = $columns['label'];
               if (!NM_is_utf8($campo_titulo))
               {
                   $campo_titulo = sc_convert_encoding($campo_titulo, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               if ($this->Use_phpspreadsheet) {
                   $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
               }
               else {
                   $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
               }
               $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $campo_titulo);
               $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
               $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
               $this->Xls_col += $colspan;
           }
           foreach ($contr_rowspan as $col => $row)
           {
               if ($col >= $this->Xls_col && $row > 1)
               {
                   $contr_rowspan[$col]--;
               }
           }
           $this->Xls_row++;
      }
      foreach ($this->array_linhas as $lines)
      {
           $this->Xls_col = 0;
           $colspan       = 0;
           foreach ($lines as $num_col => $columns)
           {
               if (0 <= $columns['level'])
               {
                   $cada_dado = $this->comp_tabular ? $columns['label'] : str_repeat('   ', $columns['level']) . $columns['label'];
               }
               else
               {
                   $cada_dado = $columns['value'];
               }
               if (is_array($cada_dado)) {
                   $cada_dado = "";
               }
               if (!NM_is_utf8($cada_dado))
               {
                   $cada_dado = sc_convert_encoding($cada_dado, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $this->Xls_col = $num_col + $colspan;
               if (isset($columns['colspan']) && $columns['colspan'] > 0)
               {
                   $colspan = ($columns['colspan'] - 1);
               }
               if (0 <= $columns['level'])
               {
                   if (!NM_is_utf8($cada_dado))
                   {
                       $cada_dado = sc_convert_encoding($cada_dado, "UTF-8", $_SESSION['scriptcase']['charset']);
                   }
                   if ($this->Use_phpspreadsheet) {
                       $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   }
                   $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $cada_dado);
               }
               else
               {
                   if (!NM_is_utf8($cada_val))
                   {
                       $cada_val = sc_convert_encoding($cada_val, "UTF-8", $_SESSION['scriptcase']['charset']);
                   }
                   if ($this->Use_phpspreadsheet) {
                       $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                   }
                   $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('');
                   $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $cada_dado);
               }
               for ($Ix = 0; $Ix < $colspan; $Ix++) {
                   $this->Xls_col++;
                   $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, "");
               }
           }
           $this->Xls_row++;
      }
      if ($this->Use_phpspreadsheet) {
          if ($this->Xls_tp == ".xlsx") {
              $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->Xls_dados);
          } 
          else {
              $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xls($this->Xls_dados);
          } 
      } 
      else {
          if ($this->Xls_tp == ".xlsx") {
              $objWriter = new PHPExcel_Writer_Excel2007($this->Xls_dados);
          } 
          else {
              $objWriter = new PHPExcel_Writer_Excel5($this->Xls_dados);
          } 
      } 
      $objWriter->save($this->Xls_f);
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_res_grid']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_res_sheet'] = $this->Xls_f;
      }
      elseif ($this->Xls_password != "")
      { 
          $str_zip = "";
          $Zip_f = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
          $Arq_input  = (FALSE !== strpos($this->Xls_f, ' ')) ? " \"" . $this->Xls_f . "\"" :  $this->Xls_f;
          if (is_file($Zip_f)) {
              unlink($Zip_f);
          }
          if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
          {
              chdir($this->Ini->path_third . "/zip/windows");
              $str_zip = "zip.exe -P -j " . $this->Xls_password . " " . $Zip_f . " " . $Arq_input;
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
              $str_zip = "./7za -p" . $this->Xls_password . " a " . $Zip_f . " " . $Arq_input;
          }
          elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
          {
              chdir($this->Ini->path_third . "/zip/mac/bin");
              $str_zip = "./7za -p" . $this->Xls_password . " a " . $Zip_f . " " . $Arq_input;
          }
          if (!empty($str_zip)) {
              exec($str_zip);
          }
          unlink($Arq_input);
          $this->Arquivo = $this->Arq_zip;
          $this->Xls_f   = $this->Zip_f;
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


   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
   }
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE> :: Excel</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XLS</td>
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
<form name="Fdown" method="get" action="grid_trouaer_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_trouaer_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trouaer_rsvp_r']['xls_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'off';
}


function PrepReltrou($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'on';
  
	date_default_timezone_set('America/Sao_Paulo');
	$_passa_part = false;
	$ret = 'ADICIONA ERRO';		
	$valor_a = 'A';
	$valor_p = 'P';
	$valor_y = 'Y';
	$valor_nu = '';
	$valor_direcao = 'VOLTA';
	$valor_tipo = 'OUT';	
	
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
			trouaer_rsvp_r
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
				participantes_rsvp.part_id_evento,                          
				transfer_rsvp.tra_dt_saida_volta AS Dt_Saida,  	             
				transfer_rsvp.tra_hr_saida_volta AS Hora_Saída,            
				transfer_rsvp.tra_dt_chegada_volta AS Dt_Chegada,             	
				transfer_rsvp.tra_hr_chegada_volta AS Hora_Chegada,           
				transfer_rsvp.tra_cia_volta AS Cia_Aerea,
				transfer_rsvp.tra_numvoo_volta AS Voo, 			                       	
				transfer_rsvp.tra_origem_volta AS Origem,                     	
				transfer_rsvp.tra_destino_volta AS Destino,                   	
				participantes_rsvp.nome_pessoa AS p_nome,                   
				participantes_rsvp.part_id_evento_publico AS p_publico,     
				participantes_rsvp.part_id_evento_regional AS p_regional,
				transfer_rsvp.tra_id_hotel_out AS Hotel,                        	
				participantes_rsvp.part_grupo AS p_grupo,                   
				participantes_rsvp.part_departamento AS p_departamento,     
				participantes_rsvp.part_cargo AS p_cargo,	                  
				participantes_rsvp.part_empresa AS p_empresa,               
				participantes_rsvp.part_email AS p_email,	                  
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01, 
				participantes_rsvp.part_celeular_01 AS p_celular_01,        
				participantes_rsvp.part_ddd_01 AS p_ddd_01,                 
				participantes_rsvp.part_fone_01 AS p_fone_01,               	
				transfer_rsvp.tra_localizador_volta AS loc_ida,               
				transfer_rsvp.tra_eticket_volta AS tkt_ida,                  
				participantes_rsvp.part_rg,                                 
				participantes_rsvp.part_cpf AS p_cpf,                       
				participantes_rsvp.part_dt_nasc,                         
				transfer_rsvp.tra_observacao AS obs,                        
				transfer_rsvp.tra_tipo AS tipo_transfer,			                 
				transfer_rsvp.tra_status AS t_status,                       
				transfer_rsvp.tra_bloqueio_volta AS bloqueio,                 
				transfer_rsvp.tra_ativo AS ativo,
				transfer_rsvp.tra_hrtransout AS hr_transfer,			
				aereos_rsvp.aereo_id_evento AS aereo_evento,
				aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
				aereos_rsvp.aereo_num_voo AS aereo_voo,
				aereos_rsvp.aereo_direcao AS aereo_direcao,
				aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans														
			FROM                                                         
				transfer_rsvp                                               
			RIGHT JOIN                                                   
				participantes_rsvp	                                         
			ON 	
				transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf 		
			RIGHT JOIN 
				aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
			AND 
				aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento			
			WHERE		
				transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."              
			AND
			   participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."  
			AND 
				transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	 
			AND                                                          
				transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)."  	                        
			AND                                                          
				transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."                                   
			AND
				transfer_rsvp.tra_cia_volta <> ".$this->Db->qstr($valor_nu)."              
			AND
				participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
			AND
				transfer_rsvp.tra_flag_volta = ".$this->Db->qstr($valor_y)."		
			AND                                                                	
				participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
			AND
				aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
			AND
				aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."													
			ORDER BY				                                                 
				participantes_rsvp.nome_pessoa		 		
			";
		} else {
			$sqlMestre = "						
			SELECT                                 		
				participantes_rsvp.part_id_evento,                          
				transfer_rsvp.tra_dt_saida_volta AS Dt_Saida,  	             
				transfer_rsvp.tra_hr_saida_volta AS Hora_Saída,            
				transfer_rsvp.tra_dt_chegada_volta AS Dt_Chegada,             	
				transfer_rsvp.tra_hr_chegada_volta AS Hora_Chegada,           
				transfer_rsvp.tra_cia_volta AS Cia_Aerea,
				transfer_rsvp.tra_numvoo_volta AS Voo, 			                       	
				transfer_rsvp.tra_origem_volta AS Origem,                     	
				transfer_rsvp.tra_destino_volta AS Destino,                   	
				participantes_rsvp.nome_pessoa AS p_nome,                   
				participantes_rsvp.part_id_evento_publico AS p_publico,     
				participantes_rsvp.part_id_evento_regional AS p_regional,
				transfer_rsvp.tra_id_hotel_out AS Hotel,                        	
				participantes_rsvp.part_grupo AS p_grupo,                   
				participantes_rsvp.part_departamento AS p_departamento,     
				participantes_rsvp.part_cargo AS p_cargo,	                  
				participantes_rsvp.part_empresa AS p_empresa,               
				participantes_rsvp.part_email AS p_email,	                  
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01, 
				participantes_rsvp.part_celeular_01 AS p_celular_01,        
				participantes_rsvp.part_ddd_01 AS p_ddd_01,                 
				participantes_rsvp.part_fone_01 AS p_fone_01,               	
				transfer_rsvp.tra_localizador_volta AS loc_ida,               
				transfer_rsvp.tra_eticket_volta AS tkt_ida,                  
				participantes_rsvp.part_rg,                                 
				participantes_rsvp.part_cpf AS p_cpf,                       
				participantes_rsvp.part_dt_nasc,                         
				transfer_rsvp.tra_observacao AS obs,                        
				transfer_rsvp.tra_tipo AS tipo_transfer,			                 
				transfer_rsvp.tra_status AS t_status,                       
				transfer_rsvp.tra_bloqueio_volta AS bloqueio,                 
				transfer_rsvp.tra_ativo AS ativo,
				transfer_rsvp.tra_hrtransout AS hr_transfer,			
				aereos_rsvp.aereo_id_evento AS aereo_evento,
				aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
				aereos_rsvp.aereo_num_voo AS aereo_voo,
				aereos_rsvp.aereo_direcao AS aereo_direcao,
				aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans,
				participantes_rsvp.dsc_empresa_rsvp
			FROM                                                         
				transfer_rsvp                                               
			RIGHT JOIN                                                   
				participantes_rsvp	                                         
			ON 	
				transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf 		
			RIGHT JOIN 
				aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
			AND 
				aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento			
			WHERE		
				transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."              
			AND
			   participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."  
			AND 
				transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	 
			AND                                                          
				transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)."  	                        
			AND                                                          
				transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."                                   
			AND
				transfer_rsvp.tra_cia_volta <> ".$this->Db->qstr($valor_nu)."              
			AND
				participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
			AND
				transfer_rsvp.tra_flag_volta = ".$this->Db->qstr($valor_y)."		
			AND                                                                	
				participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
			AND
				aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
			AND
				aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."	
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
				acompanhantes_rsvp.part_id_evento, 			
				transfer_rsvp.tra_dt_saida_volta AS Dt_Saida,  	           
				transfer_rsvp.tra_hr_saida_volta AS Hora_Saída,            
				transfer_rsvp.tra_dt_chegada_volta AS Dt_Chegada,          
				transfer_rsvp.tra_hr_chegada_volta AS Hora_Chegada,        
				transfer_rsvp.tra_cia_volta AS Cia_Aerea,                  
				transfer_rsvp.tra_numvoo_volta AS Voo, 			           
				transfer_rsvp.tra_origem_volta AS Origem,                  
				transfer_rsvp.tra_destino_volta AS Destino,  
				acompanhantes_rsvp.part_nome,			
				acompanhantes_rsvp.part_id_evento_publico AS p_publico,    
				acompanhantes_rsvp.part_id_evento_regional AS p_regional,  
				transfer_rsvp.tra_id_hotel_out AS Hotel,                       
				acompanhantes_rsvp.part_grupo AS p_grupo,                  
				acompanhantes_rsvp.part_departamento AS p_departamento,    
				acompanhantes_rsvp.part_cargo AS p_cargo,	               
				acompanhantes_rsvp.part_empresa AS p_empresa,              
				acompanhantes_rsvp.part_email AS p_email,	               
				acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
				acompanhantes_rsvp.part_celeular_01 AS p_celular_01,       
				acompanhantes_rsvp.part_ddd_01 AS p_ddd_01,                
				acompanhantes_rsvp.part_fone_01 AS p_fone_01,              
				transfer_rsvp.tra_localizador_volta AS loc_ida,            
				transfer_rsvp.tra_eticket_volta AS tkt_ida,                
				acompanhantes_rsvp.part_rg,                                
				acompanhantes_rsvp.part_cpf AS p_cpf,                      
				acompanhantes_rsvp.part_dt_nasc,                           
				transfer_rsvp.tra_observacao AS obs,                       
				transfer_rsvp.tra_tipo AS tipo_transfer,			       
				transfer_rsvp.tra_status AS t_status,                      
				transfer_rsvp.tra_bloqueio_volta AS bloqueio,              
				transfer_rsvp.tra_ativo AS ativo,                          
				transfer_rsvp.tra_hrtransout AS hr_transfer,			
				aereos_rsvp.aereo_id_evento AS aereo_evento,
				aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
				aereos_rsvp.aereo_num_voo AS aereo_voo,
				aereos_rsvp.aereo_direcao AS aereo_direcao,
				aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans														
			FROM                                                         					
				transfer_rsvp                                                                   
			RIGHT JOIN                                                                      
				acompanhantes_rsvp	                                                              
			ON 	                                                                            
				transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf			              
			RIGHT JOIN 
				aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
			AND 
				aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento			
			WHERE                                                                           
				transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."                  
			AND                                                                             
			   acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)." 		
			AND                                                                             
				transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	                    
			AND                                                                             
				transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)." 	                              
			AND                                                                             
				transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."                                     
			AND                                                                             
				transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)."	                                                             
			AND                                                                             
				transfer_rsvp.tra_cia_volta <> ".$this->Db->qstr($valor_nu)."			        
			AND                                                                             
				transfer_rsvp.tra_flag_volta = ".$this->Db->qstr($valor_y)."
			AND                                                                	
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
			AND
				aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
			AND
				aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."													
			ORDER BY				                                                                   
				acompanhantes_rsvp.part_nome				                                                   
			";
		} else {
			$sqlMestre = "		
			SELECT                                                          									
				acompanhantes_rsvp.part_id_evento, 			
				transfer_rsvp.tra_dt_saida_volta AS Dt_Saida,  	           
				transfer_rsvp.tra_hr_saida_volta AS Hora_Saída,            
				transfer_rsvp.tra_dt_chegada_volta AS Dt_Chegada,          
				transfer_rsvp.tra_hr_chegada_volta AS Hora_Chegada,        
				transfer_rsvp.tra_cia_volta AS Cia_Aerea,                  
				transfer_rsvp.tra_numvoo_volta AS Voo, 			           
				transfer_rsvp.tra_origem_volta AS Origem,                  
				transfer_rsvp.tra_destino_volta AS Destino,  
				acompanhantes_rsvp.part_nome,			
				acompanhantes_rsvp.part_id_evento_publico AS p_publico,    
				acompanhantes_rsvp.part_id_evento_regional AS p_regional,  
				transfer_rsvp.tra_id_hotel_out AS Hotel,                       
				acompanhantes_rsvp.part_grupo AS p_grupo,                  
				acompanhantes_rsvp.part_departamento AS p_departamento,    
				acompanhantes_rsvp.part_cargo AS p_cargo,	               
				acompanhantes_rsvp.part_empresa AS p_empresa,              
				acompanhantes_rsvp.part_email AS p_email,	               
				acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
				acompanhantes_rsvp.part_celeular_01 AS p_celular_01,       
				acompanhantes_rsvp.part_ddd_01 AS p_ddd_01,                
				acompanhantes_rsvp.part_fone_01 AS p_fone_01,              
				transfer_rsvp.tra_localizador_volta AS loc_ida,            
				transfer_rsvp.tra_eticket_volta AS tkt_ida,                
				acompanhantes_rsvp.part_rg,                                
				acompanhantes_rsvp.part_cpf AS p_cpf,                      
				acompanhantes_rsvp.part_dt_nasc,                           
				transfer_rsvp.tra_observacao AS obs,                       
				transfer_rsvp.tra_tipo AS tipo_transfer,			       
				transfer_rsvp.tra_status AS t_status,                      
				transfer_rsvp.tra_bloqueio_volta AS bloqueio,              
				transfer_rsvp.tra_ativo AS ativo,                          
				transfer_rsvp.tra_hrtransout AS hr_transfer,			
				aereos_rsvp.aereo_id_evento AS aereo_evento,
				aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
				aereos_rsvp.aereo_num_voo AS aereo_voo,
				aereos_rsvp.aereo_direcao AS aereo_direcao,
				aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans,
				acompanhantes_rsvp.dsc_empresa_rsvp
			FROM                                                         					
				transfer_rsvp                                                                   
			RIGHT JOIN                                                                      
				acompanhantes_rsvp	                                                              
			ON 	                                                                            
				transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf			              
			RIGHT JOIN 
				aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
			AND 
				aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento			
			WHERE                                                                           
				transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."                  
			AND                                                                             
			   acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)." 		
			AND                                                                             
				transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	                    
			AND                                                                             
				transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)." 	                              
			AND                                                                             
				transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."                                     
			AND                                                                             
				transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)."	                                                             
			AND                                                                             
				transfer_rsvp.tra_cia_volta <> ".$this->Db->qstr($valor_nu)."			        
			AND                                                                             
				transfer_rsvp.tra_flag_volta = ".$this->Db->qstr($valor_y)."
			AND                                                                	
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
			AND
				aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
			AND
				aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."		
			AND
				acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."	
			ORDER BY				                                                                   
				acompanhantes_rsvp.part_nome				                                                   
			";
		}
		$_passa_part = true;	
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
				$w_id_evento      	= $rsm[$i][0];  
				$w_data_saida     	= $rsm[$i][1];  
				$w_hora_saida     	= $rsm[$i][2];  
				$w_data_chegada   	= $rsm[$i][3];  
				$w_hora_chegada   	= $rsm[$i][4];  
				$w_cia_aerea 	  	= $rsm[$i][5];    
				$w_num_voo        	= $rsm[$i][35];  
				$w_origem 		  	= $rsm[$i][7];    
				$w_destino		  	= $rsm[$i][8];    
				$w_participante		= $rsm[$i][9];    
				$w_publico		  	= $rsm[$i][10];   
				$w_regional	      	= $rsm[$i][11]; 
				$w_hotel			= $rsm[$i][12];   
				$w_grupo_dsc        = $rsm[$i][13];
				$w_depto_dsc        = $rsm[$i][14];
				$w_cargo_dsc        = $rsm[$i][15];
				$w_empresa_dsc      = $rsm[$i][16];
				$w_e_mail           = $rsm[$i][17];
				$w_ddd_celular      = $rsm[$i][18];
				$w_celular          = $rsm[$i][19];
				$w_ddd_01           = $rsm[$i][20];
				$w_fone_01          = $rsm[$i][21];
				$w_localizador      = $rsm[$i][22];
				$w_eticket          = $rsm[$i][23];
				$w_rg               = $rsm[$i][24];
				$w_cpf              = $rsm[$i][25];
				$w_dtnasc           = $rsm[$i][26];
				$w_observacoes      = $rsm[$i][27];
				$w_tipo_transfer    = $rsm[$i][28];
				$w_status           = $rsm[$i][29];
				$w_cod_bloqueio     = $rsm[$i][30];
				$w_ativo            = $rsm[$i][31];
				$w_hrtransout       = $rsm[$i][32];							
				$w_tipo_pessoa  	= "PARTICIPANTE";	
			} else {
				
				$w_id_evento      	= $rsm[$i][0];  
				$w_data_saida     	= $rsm[$i][1];  
				$w_hora_saida     	= $rsm[$i][2];  
				$w_data_chegada   	= $rsm[$i][3];  
				$w_hora_chegada   	= $rsm[$i][4];  
				$w_cia_aerea 	  	= $rsm[$i][5];    
				$w_num_voo        	= $rsm[$i][35];  
				$w_origem 		  	= $rsm[$i][7];    
				$w_destino		  	= $rsm[$i][8];    
				$w_participante		= $rsm[$i][9];    
				$w_publico		  	= $rsm[$i][10];   
				$w_regional	      	= $rsm[$i][11]; 
				$w_hotel			= $rsm[$i][12];   
				$w_grupo_dsc        = $rsm[$i][13];
				$w_depto_dsc        = $rsm[$i][14];
				$w_cargo_dsc        = $rsm[$i][15];
				$w_empresa_dsc      = $rsm[$i][16];
				$w_e_mail           = $rsm[$i][17];
				$w_ddd_celular      = $rsm[$i][18];
				$w_celular          = $rsm[$i][19];
				$w_ddd_01           = $rsm[$i][20];
				$w_fone_01          = $rsm[$i][21];
				$w_localizador      = $rsm[$i][22];
				$w_eticket          = $rsm[$i][23];
				$w_rg               = $rsm[$i][24];
				$w_cpf              = $rsm[$i][25];
				$w_dtnasc           = $rsm[$i][26];
				$w_observacoes      = $rsm[$i][27];
				$w_tipo_transfer    = $rsm[$i][28];
				$w_status           = $rsm[$i][29];
				$w_cod_bloqueio     = $rsm[$i][30];
				$w_ativo            = $rsm[$i][31];
				$w_hrtransout       = $rsm[$i][32];							
				$w_tipo_pessoa  	= "ACOMPANHANTE";	
			}
			$sqlAereo = "			
			SELECT
				aereo_id_evento,
				aereo_cpf_particip,
				aereo_emitida_bvt,
				aereo_bloqueio_id,
				aereo_localizador,
				aereo_num_voo,
				nota_gate,
				data_nota_gate,
				aereo_direcao					
			FROM
				aereos_rsvp
			WHERE
				aereo_id_evento = ".$this->Db->qstr($vp_evento)."
			AND
				aereo_cpf_particip = ".$this->Db->qstr($w_cpf)."
			AND
				aereo_localizador = ".$this->Db->qstr($w_localizador)."
			AND
				aereo_num_voo = ".$this->Db->qstr($w_num_voo)."
			ORDER BY
				aereo_id_evento,aereo_cpf_particip,aereo_localizador
			";
			 
      $nm_select = $sqlAereo; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaer = false;
          $rsaer_erro = $this->Db->ErrorMsg();
      } 
				
			if (isset($rsaer[0][0])) {					
				if ($rsaer[0][2] == 'Y') {
					$w_emitidaBvt = "SIM";
				} else {
					$w_emitidaBvt = "NAO";
				}
				$w_notaGate = $rsaer[0][6];
				$w_dtNotagate = $rsaer[0][7];
				$w_direcao = $rsaer[0][8];					
			} else {
				$w_emitidaBvt = "ERR";				
			}				
			
			$sqlCia = "			
			SELECT
				cia_id,
				cia_sigla,
				cia_nome
			FROM
				tbl_cia_aereas
			WHERE
				cia_id = ".$this->Db->qstr($w_cia_aerea)."
			ORDER BY
				cia_id
			";
			 
      $nm_select = $sqlCia; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscia = false;
          $rscia_erro = $this->Db->ErrorMsg();
      } 
				
			if (isset($rscia[0][0])) {									
				$w_ciaAereaSigla = $rscia[0][2];
			} else {
				$w_ciaAereaSigla = "ERR";				
			}		
			
				$sqlCia = "			
				SELECT
					cia_id,
					cia_sigla,
					cia_nome
				FROM
					tbl_cia_aereas
				WHERE
					cia_id = ".$this->Db->qstr($w_cia_aerea)."
				ORDER BY
					cia_id
				";
				 
      $nm_select = $sqlCia; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscia = false;
          $rscia_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rscia[0][0])) {									
					$w_ciaAereaSigla = $rscia[0][2];
				} else {
					$w_ciaAereaSigla = "ERR";				
				}					
			
			
			$sqlAerop = "			
			SELECT
				COD_AEROPORTO,
				SIGLA,
				NOM_AEROPORTO,
				NOM_CIDADE
			FROM
				aeroporto
			WHERE
				COD_AEROPORTO = ".$this->Db->qstr($w_origem)."
			ORDER BY
				COD_AEROPORTO					
			";
			 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaerop = false;
          $rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
			if (isset($rsaerop[0][0])) {									
				$w_origemSigla = $rsaerop[0][1]; 
			} else {
				$w_origemSigla = "ERR";				
			}	
			$sqlAerop = "			
			SELECT
				COD_AEROPORTO,
				SIGLA,
				NOM_AEROPORTO,
				NOM_CIDADE
			FROM
				aeroporto
			WHERE
				COD_AEROPORTO = ".$this->Db->qstr($w_destino)."
			ORDER BY
				COD_AEROPORTO					
			";
			 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaerop = false;
          $rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
			if (isset($rsaerop[0][0])) {									
				$w_destinoSigla = $rsaerop[0][1]; 
			} else {
				$w_destinoSigla = "ERR";				
			}	
			if ($w_publico <> '0') {
				$sqlPub = "			
				SELECT
					publico_id,
					publico_nome
				FROM
					publico_rsvp
				WHERE
					publico_id = ".$this->Db->qstr($w_publico)."
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
			if ($w_regional <> '0') {
				$sqlReg = "								
				SELECT
					regional_id,
					regional_dsc
				FROM
					tbl_regionais
				WHERE
					regional_id = ".$this->Db->qstr($w_regional)."
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
			if ($w_hotel <> '0') {
				$sqlHot = "								
				SELECT
					hotel_id,
					hotel_fantasia
				FROM
					tbl_hoteis
				WHERE
					hotel_id = ".$this->Db->qstr($w_hotel)."
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
					pessoa_cpf = ".$this->Db->qstr($w_cpf)."
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
					trouaer_rsvp_r
				WHERE 
					cpf = ".$this->Db->qstr($w_cpf)." 
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
					trouaer_rsvp_r	      			
					(id_evento,		         			
					data_saida,        			
					hora_saida,        			
					data_chegada,      			
					hora_chegada,      						
					cia_aerea,         			
					num_voo,           			
					origem,            			
					destino,           			
					participante,	     			
					publico,           			
					regional,          			
					hotel,             			
					grupo_dsc,         						
					departamento_dsc,  			
					cargo_dsc,         			
					empresa_dsc,       			
					e_mail,            			
					ddd_celular,       			
					celular,           			
					ddd_01,            			
					fone_01,           			
					localizador,       			
					eticket,           			
					rg,                			
					cpf,               			
					data_nascimento,   			
					observacoes,       									
					tipo_transfer,                 
					tipo_pessoa,       
					status,			         
					cod_bloqueio,      
					ativo,             
					id_usuario_relato, 
					comprado_belvitur, 
					nota_gate,         
					data_nota_gate,    
					cia_aerea_sigla,   
					direcao,           
					origem_sigla,	     
					destino_sigla,     
					publico_dsc,       
					regional_dsc,      
					hotel_dsc,         
					usuario_relato_dsc,
					evento_dsc,		      
					horario_transfer)  
				VALUES                 
					(".$this->Db->qstr($w_id_evento).",     
					".$this->Db->qstr($w_data_saida).",    
					".$this->Db->qstr($w_hora_saida).",    
					".$this->Db->qstr($w_data_chegada).",  
					".$this->Db->qstr($w_hora_chegada).",  
					".$this->Db->qstr($w_cia_aerea).", 
					".$this->Db->qstr($w_num_voo).", 
					".$this->Db->qstr($w_origem).", 
					".$this->Db->qstr($w_destino).", 
					".$this->Db->qstr($w_participante).", 
					".$this->Db->qstr($w_publico).",	 
					".$this->Db->qstr($w_regional).",	     
					".$this->Db->qstr($w_hotel).",		
					".$this->Db->qstr($w_grupo_dsc).",     
					".$this->Db->qstr($w_depto_dsc).",     
					".$this->Db->qstr($w_cargo_dsc).",     
					".$this->Db->qstr($w_empresa_dsc).",   
					".$this->Db->qstr($w_e_mail).",        
					".$this->Db->qstr($w_ddd_celular).",   
					".$this->Db->qstr($w_celular).",     	 
					".$this->Db->qstr($w_ddd_01).",        
					".$this->Db->qstr($w_fone_01).",       
					".$this->Db->qstr($w_localizador).",   
					".$this->Db->qstr($w_eticket).",       
					".$this->Db->qstr($w_rg).",            
					".$this->Db->qstr($w_cpf).",           
					".$this->Db->qstr($w_dtnasc).",        
					".$this->Db->qstr($w_observacoes).",   
					".$this->Db->qstr($w_tipo_transfer).", 
					".$this->Db->qstr($w_tipo_pessoa).",  
					".$this->Db->qstr($w_status).",        
					".$this->Db->qstr($w_cod_bloqueio).",  
					".$this->Db->qstr($w_ativo).",         
					".$this->Db->qstr($vp_usuario).", 
					".$this->Db->qstr($w_emitidaBvt).",    
					".$this->Db->qstr($w_notaGate).",      
					".$this->Db->qstr($w_dtNotagate).",    
					".$this->Db->qstr($w_ciaAereaSigla).",
					".$this->Db->qstr($w_direcao).",      
					".$this->Db->qstr($w_origemSigla).",  
					".$this->Db->qstr($w_destinoSigla).", 
					".$this->Db->qstr($w_publicoDsc).",   
					".$this->Db->qstr($w_regionalDsc).",  
					".$this->Db->qstr($w_hotelDsc).",     
					".$this->Db->qstr($w_usurelDsc).",    
					".$this->Db->qstr($w_eventoDsc).",
					".$this->Db->qstr($w_hrtransout).")  	
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
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trouaer_rsvp_r']['contr_erro'] = 'off';
}

}

?>
