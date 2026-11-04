<?php

class grid_aereopar_rsvp_r_res_xml
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
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("pt_br");
   }

   //---- 
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_res_grid']))
      {
          return;
      }
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xml_f);
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
      $this->New_Format  = true;
      $this->Xml_password  = "";
      if (isset($_REQUEST['nm_xml_tag']) && !empty($_REQUEST['nm_xml_tag']))
      {
          $this->New_Format = ($_REQUEST['nm_xml_tag'] == "tag") ? true : false;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
      $this->array_titulos = array();
      $this->array_linhas  = array();
      $this->campo_titulo  = array();
      $this->nm_data       = new nm_data("pt_br");
      $this->Arquivo       = "sc_xml";
      $this->Arquivo      .= "_" . date('YmdHis') . "_" . rand(0, 1000);
      $this->Arq_zip       = $this->Arquivo . "_grid_aereopar_rsvp_r.zip";
      $this->Arquivo      .= "_grid_aereopar_rsvp_r";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_res_grid']))
      {
          $this->Arquivo      .= "_" . $this->Ini->Nm_lang['lang_othr_smry_titl'];
      }
      $this->Arquivo_view  = $this->Arquivo . "_view.xml";
      $this->Arquivo      .= ".xml";
      $this->Tit_doc       = "grid_aereopar_rsvp_r.xml";
      $this->Tit_zip       = "grid_aereopar_rsvp_r.zip";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->Res       = new grid_aereopar_rsvp_r_resumo("out");
      $this->prep_modulos("Res");
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_res_grid']) && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_aereopar_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_return']);
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
      $xml_charset = $_SESSION['scriptcase']['charset'];
      $this->Xml_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      $xml_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
      fwrite($xml_f, "<root>\r\n");
      if ($this->New_Format)
      {
          fwrite($xml_f, "<grid_aereopar_rsvp_r>\r\n");
      }
      if ($this->Grava_view)
      {
          $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
          $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
          fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
          fwrite($xml_v, "<root>\r\n");
          if ($this->New_Format)
          {
              fwrite($xml_v, "<grid_aereopar_rsvp_r>\r\n");
          }
      }
      $this->Res->resumo_export();
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_res_grid']) && !$this->Ini->sc_export_ajax) {
          $Mens_bar  = $this->Ini->Nm_lang['lang_othr_prcs'];
          $Mens_smry = $this->Ini->Nm_lang['lang_othr_smry_titl'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar  = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              $Mens_smry = sc_convert_encoding($Mens_smry, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
          $this->pb->addSteps(30);
      }
      $label_index = 'label';
      if (isset($_REQUEST['nm_xml_label']) && 'N' == $_REQUEST['nm_xml_label']) {
          $label_index = 'field_name';
      }
      $this->array_titulos = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['arr_export']['label'];
      $this->array_linhas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['arr_export']['data'];
      $contr_rowspan = array();
      $tit_rowspan   = array();
      foreach ($this->array_titulos as $lines)
      {
           $col = 0;
           foreach ($lines as $columns)
           {
               $col_ok = false;
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? $columns['colspan'] : 1;
               while (!$col_ok)
               {
                   if (isset($contr_rowspan[$col]) && 1 < $contr_rowspan[$col])
                   {
                       if (isset($this->campo_titulo[$col]))   
                       {
                          $this->campo_titulo[$col] .= "_";
                       }
                       $this->campo_titulo[$col] .= $tit_rowspan[$col];
                       $contr_rowspan[$col]--;
                       $col++;
                   }
                   else
                   {
                       $col_ok = true;
                   }
               }
               $col_t = $col;
               if (isset($columns['rowspan']) && 1 < $columns['rowspan'])
               {
                   $contr_rowspan[$col] = $columns['rowspan'];
                   for ($x = 0; $x < $colspan; $x++)
                   {
                        if (isset($tit_rowspan[$col_t]))   
                        {
                            $tit_rowspan[$col_t] .= "_";
                        }
                        $tit_rowspan[$col_t] .= $columns[$label_index];
                       $col_t++;
                   }
               }
               for ($x = 0; $x < $colspan; $x++)
               {
                    if (isset($this->campo_titulo[$col]))   
                    {
                       $this->campo_titulo[$col] .= "_";
                    }
                    $this->campo_titulo[$col] .= $columns[$label_index];
                   $col++;
               }
           }
           foreach ($contr_rowspan as $col_t => $row)
           {
               if ($col_t >= $col && $row > 1)
               {
                   $contr_rowspan[$col]--;
               }
           }
      }
      foreach ($this->campo_titulo as $col => $titulo)
      {
          if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->campo_titulo[$col]))
          {
              $this->campo_titulo[$col] = sc_convert_encoding($this->campo_titulo[$col], "UTF-8", $_SESSION['scriptcase']['charset']);
          }
      }
      $this->grava_linha($xml_f);
      if ($this->New_Format)
      {
          fwrite($xml_f, "</grid_aereopar_rsvp_r>\r\n");
      }
      fwrite($xml_f, "</root>");
      fclose($xml_f);
      if ($this->Grava_view)
      {
          $this->grava_linha($xml_v);
          if ($this->New_Format)
          {
              fwrite($xml_v, "</grid_aereopar_rsvp_r>\r\n");
          }
          fwrite($xml_v, "</root>");
          fclose($xml_v);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_res_grid']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_res_file']['xml'] = $this->Xml_f;
          if ($this->Grava_view)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_res_file']['view'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
          }
      }
      elseif ($this->Xml_password != "")
      { 
          $str_zip = "";
          $Zip_f = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
          $Arq_input  = (FALSE !== strpos($this->Xml_f, ' ')) ? " \"" . $this->Xml_f . "\"" :  $this->Xml_f;
          if (is_file($Zip_f)) {
              unlink($Zip_f);
          }
          if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
          {
              chdir($this->Ini->path_third . "/zip/windows");
              $str_zip = "zip.exe -P -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
              $str_zip = "./7za -p" . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
          }
          elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
          {
              chdir($this->Ini->path_third . "/zip/mac/bin");
              $str_zip = "./7za -p" . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
          $this->Xml_f   = $this->Zip_f;
          $this->Tit_doc = $this->Tit_zip;
          if ($this->Grava_view)
          {
              $str_zip = "";
              $xml_view_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
              $zip_view_f = str_replace(".zip", "_view.zip", $this->Zip_f);
              $zip_arq_v  = str_replace(".zip", "_view.zip", $this->Arq_zip);
              $Zip_f      = (FALSE !== strpos(\zip_view_f, ' ')) ? " \"" . \zip_view_f . "\"" :  \zip_view_f;
              $Arq_input  = (FALSE !== strpos($xml_view_f, ' ')) ? " \"" . $xml_view_f . "\"" :  $xml_view_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe -P -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
                 $str_zip = "./7za -p" . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                 $str_zip = "./7za -p" . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              if (!empty($str_zip)) {
                  exec($str_zip);
              }
              unlink($Arq_input);
              $this->Arquivo_view = $zip_arq_v;
              // ----- ZIP log
              $fp = @fopen(str_replace(".zip", ".log", $Zip_f), 'a');
              if ($fp)
              {
                  @fwrite($fp, $str_zip . "\r\n\r\n");
                  @fclose($fp);
              }
          } 
          else 
          {
              $this->Arquivo_view = $this->Arq_zip;
          } 
      } 
   }

   //----- 
   function grava_linha($xml_f)
   {
      $contr_rowspan = "";
      $tit_rowspan   = "";
      foreach ($this->array_linhas as $lines)
      {
          $col           = 0;
          $lab           = "";
          $cmp           = false;
          $xml_registro  = "";
          if (!$this->New_Format)
          {
              $xml_registro = "<grid_aereopar_rsvp_r";
          }
          foreach ($lines as $columns)
          {
              if (0 <= $columns['level'])
              {
                  $cada_dado = $columns['label'];
                  $cada_dado = str_replace("&nbsp;", "", $cada_dado);
                  if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($cada_dado))
                  {
                      $cada_dado = sc_convert_encoding($cada_dado, "UTF-8", $_SESSION['scriptcase']['charset']);
                  }
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
                  if (!$cmp)
                  {
                      if (!empty($contr_rowspan) && $contr_rowspan > 0)
                      {
                          $lab = $tit_rowspan . "_" . $lab;
                          $contr_rowspan--;
                      }
                      $this->clear_tag($lab);
                      if ($this->New_Format)
                      {
                          $xml_registro .= "<" . $lab . ">\r\n";
                      }
                      else
                      {
                          $xml_registro .= " Campo=\"" . $lab . "\"";
                      }
                      $cmp = true;
                  }
                  $cada_dado = $columns['value'];
                  if (is_array($cada_dado)) {
                      $cada_dado = "";
                  }
                  $cada_tit  = $this->trata_dados($this->campo_titulo[$col]);
                  $this->clear_tag($cada_tit);
                  if ($this->New_Format)
                  {
                      $xml_registro .= " <" . $cada_tit . ">" . $cada_dado . "</" . $cada_tit . ">\r\n";
                  }
                  else
                  {
                      $xml_registro .= " " . $cada_tit . "=\"" . $cada_dado . "\"";
                  }
                  $col++;
              }
          }
          if ($this->New_Format && $cmp)
          {
              $xml_registro .= "</" . $lab . ">\r\n";
          }
          if (!$this->New_Format)
          {
              $xml_registro .= " />\r\n";
          }
          fwrite($xml_f, $xml_registro);
      }
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp = $conteudo;
      $str_temp = str_replace("<br />", "",  $str_temp);
      $str_temp = str_replace("&", "&amp;",  $str_temp);
      $str_temp = str_replace("<", "&lt;",   $str_temp);
      $str_temp = str_replace(">", "&gt;",   $str_temp);
      $str_temp = str_replace("'", "&apos;", $str_temp);
      $str_temp = str_replace('"', "&quot;",  $str_temp);
      $str_temp = str_replace('(', "_",  $str_temp);
      $str_temp = str_replace(')', "",  $str_temp);
      return ($str_temp);
   }

   function clear_tag(&$conteudo)
   {
      $out = (is_numeric(substr($conteudo, 0, 1)) || substr($conteudo, 0, 1) == "") ? "_" : "";
      $str_temp = "abcdefghijklmnopqrstuvwxyz0123456789";
      for ($i = 0; $i < strlen($conteudo); $i++)
      {
          $char = substr($conteudo, $i, 1);
          $ok = false;
          for ($z = 0; $z < strlen($str_temp); $z++)
          {
              if (strtolower($char) == substr($str_temp, $z, 1))
              {
                  $ok = true;
                  break;
              }
          }
          $out .= ($ok) ? $char : "_";
      }
      $conteudo = $out;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>BRSVP - Aéreo Participantes :: XML</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XML</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_aereopar_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_aereopar_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xml_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepR2($evento,$vp_usuario,$vp_tipo,$vp_nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$ret = 'ADICIONA OK2';
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
					evento_id = ".$this->Db->qstr($evento)."
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
		if($vp_nivel == 'CONVIDADO') {
			$sqlj = "
			SELECT 
				aereos_rsvp.aereo_id_evento AS a_evento,
				aereos_rsvp.aereo_id_usuario AS a_usuario,
				usuarios_rsvp.usuario_nome AS usuario_nome,
				aereos_rsvp.aereo_cpf_particip AS a_cpf,
				CASE aereos_rsvp.aereo_status 
					WHEN 'Y' THEN 'CONFIRMADO'
					WHEN 'A' THEN 'ABERTO'
					WHEN 'P' THEN 'PENDENTE'
					WHEN 'N' THEN 'NÃO CONFIRMADO'
				END
				AS a_status,
				aereos_rsvp.aereo_direcao AS a_direcao,
				aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
				tbl_cia_aereas.cia_nome AS cia_aerea,
				aereos_rsvp.aereo_num_voo AS a_voo,
				CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
				CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
				aereos_rsvp.aereo_dt_saida AS a_dt_saida,
				aereos_rsvp.aereo_hr_saida AS a_hr_saida,
				aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
				aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
				aereos_rsvp.aereo_localizador AS a_localizador,
				aereos_rsvp.aereo_eticket AS a_etkt,				
				IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
				aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
				bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
				aereos_rsvp.aereo_modificado_em AS a_modificado_em,
				aereos_rsvp.aereo_ativo AS a_ativo,
				aereos_rsvp.nome_pax_gate AS a_pax_gate,
				aereos_rsvp.nota_gate AS a_nota_gate,
				aereos_rsvp.data_nota_gate AS a_dt_nota_gate			
			FROM
				aereos_rsvp
			INNER JOIN 	
				usuarios_rsvp
			ON	
				usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
			INNER JOIN 	
				acompanhantes_rsvp
			ON
				acompanhantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
			INNER JOIN
				tbl_cia_aereas
			ON
				tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
			INNER JOIN
				aeroporto AS orig				
			ON
				aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
			INNER JOIN
				aeroporto AS dest		
			ON		 
				aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
			LEFT JOIN
				bloqueio_aereo_rsvp	
			ON 
				aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
			WHERE
				aereos_rsvp.aereo_ativo =  ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
			AND
				aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
			AND
				aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
			ORDER BY
				aereos_rsvp.aereo_cpf_particip,
				aereos_rsvp.aereo_dthr_saida,
				aereos_rsvp.aereo_direcao			
			";
		} else {
			$sqlj = "
			SELECT 
				aereos_rsvp.aereo_id_evento AS a_evento,
				aereos_rsvp.aereo_id_usuario AS a_usuario,
				usuarios_rsvp.usuario_nome AS usuario_nome,
				aereos_rsvp.aereo_cpf_particip AS a_cpf,
				CASE aereos_rsvp.aereo_status 
					WHEN 'Y' THEN 'CONFIRMADO'
					WHEN 'A' THEN 'ABERTO'
					WHEN 'P' THEN 'PENDENTE'
					WHEN 'N' THEN 'NÃO CONFIRMADO'
				END
				AS a_status,
				aereos_rsvp.aereo_direcao AS a_direcao,
				aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
				tbl_cia_aereas.cia_nome AS cia_aerea,
				aereos_rsvp.aereo_num_voo AS a_voo,
				CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
				CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
				aereos_rsvp.aereo_dt_saida AS a_dt_saida,
				aereos_rsvp.aereo_hr_saida AS a_hr_saida,
				aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
				aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
				aereos_rsvp.aereo_localizador AS a_localizador,
				aereos_rsvp.aereo_eticket AS a_etkt,				
				IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
				aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
				bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
				aereos_rsvp.aereo_modificado_em AS a_modificado_em,
				aereos_rsvp.aereo_ativo AS a_ativo,
				aereos_rsvp.nome_pax_gate AS a_pax_gate,
				aereos_rsvp.nota_gate AS a_nota_gate,
				aereos_rsvp.data_nota_gate AS a_dt_nota_gate			
			FROM
				aereos_rsvp
			INNER JOIN 	
				usuarios_rsvp
			ON	
				usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
			INNER JOIN 	
				acompanhantes_rsvp
			ON
				acompanhantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
			INNER JOIN
				tbl_cia_aereas
			ON
				tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
			INNER JOIN
				aeroporto AS orig				
			ON
				aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
			INNER JOIN
				aeroporto AS dest		
			ON		 
				aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
			LEFT JOIN
				bloqueio_aereo_rsvp	
			ON 
				aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
			WHERE
				aereos_rsvp.aereo_ativo =  ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
			AND
				aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
			AND
				aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
			ORDER BY
				aereos_rsvp.aereo_cpf_particip,
				aereos_rsvp.aereo_dthr_saida,
				aereos_rsvp.aereo_direcao			
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
				$v_evento				= $rsj[$i][0]; 	
				$v_usuario				= $rsj[$i][1];		
				$v_usuario_nome			= $rsj[$i][2]; 	
				$v_cpf					= $rsj[$i][3]; 	
				$v_status				= $rsj[$i][4]; 	
				$v_direcao				= $rsj[$i][5]; 	
				$v_cod_cia_aerea		= $rsj[$i][6]; 	
				$v_cia_aerea			= $rsj[$i][7]; 	
				$v_voo					= $rsj[$i][8];		
				$v_origem				= $rsj[$i][9]; 	
				$v_destino				= $rsj[$i][10];	
				$v_dt_saida				= $rsj[$i][11];	
				$v_hr_saida				= $rsj[$i][12];	
				$v_dt_chegada			= $rsj[$i][13];	
				$v_hr_chegada			= $rsj[$i][14];	
				$v_localizador			= $rsj[$i][15];	
				$v_etkt					= $rsj[$i][16];	
				$v_emitida_bvt			= $rsj[$i][17];	
				$v_bloqueio				= $rsj[$i][18];	
				$v_dbloqueio			= $rsj[$i][19];	
				$v_modificado_em		= $rsj[$i][20];	
				$v_ativo				= $rsj[$i][21];	
				$v_pax_gate				= $rsj[$i][22];	
				$v_nota_gate			= $rsj[$i][23];	
				$v_dt_nota_gate			= $rsj[$i][24];	
				$v_tipoPessoa			= "ACOMPANHANTE";
				$sqlPes = "								
				SELECT						
					pessoa_cpf,
					pessoa_nome				
				FROM
					pessoas_rsvp
				WHERE
					pessoa_cpf = ".$this->Db->qstr($v_cpf)."
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
					$v_participante_nome = $rspes[0][1];
				} else {
					$v_participante_nome = "ERRO";				
				}													
				$reg_count = 1;	
				$sqlc = "						
				SELECT 
					aereopar_rsvp_r.id_evento, 
					aereopar_rsvp_r.participante_cpf,
					aereopar_rsvp_r.direcao,
					aereopar_rsvp_r.cod_cia_aerea,
					aereopar_rsvp_r.origem,
					aereopar_rsvp_r.voo,
					aereopar_rsvp_r.hora_saida,
					aereopar_rsvp_r.data_saida	
				FROM 
					aereopar_rsvp_r 
				WHERE 
					aereopar_rsvp_r.id_evento = ".$this->Db->qstr($v_evento)."
				AND 
					aereopar_rsvp_r.participante_cpf = ".$this->Db->qstr($v_cpf)."
				AND
					aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)."
				AND
					aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."
				AND
					aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)."
				AND
					aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)."
				AND	
					aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)."
				AND	
					aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)."
				AND
					aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				";	
				 
      $nm_select = $sqlc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsc = false;
          $rsc_erro = $this->Db->ErrorMsg();
      } 
	
				if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

				$reg_count = sizeof($rsc );	
				if ($reg_count == 0) {					
																	
					if($v_bloqueio <> '0') {
						
						$_usado_bloqueio = '1';
						$sqlbs="
						SELECT 
							bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
						FROM
							bloqueio_aereo_rsvp
						WHERE
							bloqueio_id = ".$this->Db->qstr($v_bloqueio)."
						AND
							bloq_evento_id = ".$this->Db->qstr($evento)."
						ORDER BY
							bloqueio_id,bloq_evento_id
						";							
						 
      $nm_select = $sqlbs; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsbs = false;
          $rsbs_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($rsbs[0][0])) {	
							$_sentido 	= $rsbs[0][2];									
							$_total_bloq = $rsbs[0][3];									
						}										
					} else {
						$_sentido	= '';															
						$_total_bloq = '0';								
						$_usado_bloqueio = '0';
					}					
					$sqlins = "
						SELECT 
							COUNT(p_cpf) as qtde
						FROM 
							aereopar_rsvp_r
						WHERE 
							participante_cpf = ".$this->Db->qstr($v_cpf)." 
						AND 
							id_evento = ".$this->Db->qstr($v_evento)."									
						AND
							direcao = ".$this->Db->qstr($v_direcao)."
						AND
							cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."
						AND
							origem = ".$this->Db->qstr($v_origem)."
						AND
							voo = ".$this->Db->qstr($v_voo)."
						AND	
							hora_saida = ".$this->Db->qstr($v_hr_saida)."
						AND	
							data_saida = ".$this->Db->qstr($v_dt_saida)."	
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
						$sqli2 = "					
						INSERT INTO
							aereopar_rsvp_r  
							(id_evento,
							id_usuario,
							usuario_nome,
							participante_cpf,
							participante_nome,
							satus,
							direcao,
							cod_cia_aerea,
							cia_aerea,
							voo,
							origem,
							destino,
							data_saida,
							hora_saida,
							data_chegada,
							hora_chegada,
							localizador,
							etkt,	
							emitida_bvt,
							bloqueio,
							bloqueio_dsc,
							modificado_em,
							ativo,
							pax_gate,
							nota_gate,
							data_nota_gate,							
							id_usuario_relato,
							tipo_pessoa,
							usado_bloqueio,
							total_bloqueio,
							direcao_bloqueio)							
						VALUES
							(".$this->Db->qstr($v_evento).", 				 
							".$this->Db->qstr($v_usuario).",               
							".$this->Db->qstr($v_usuario_nome).",         
							".$this->Db->qstr($v_cpf).",                
							".$this->Db->qstr($v_participante_nome).",     
							".$this->Db->qstr($v_status).",                       
							".$this->Db->qstr($v_direcao).",               
							".$this->Db->qstr($v_cod_cia_aerea).",         
							".$this->Db->qstr($v_cia_aerea).",             
							".$this->Db->qstr($v_voo).",                   
							".$this->Db->qstr($v_origem).",               
							".$this->Db->qstr($v_destino).",               
							".$this->Db->qstr($v_dt_saida).",              
							".$this->Db->qstr($v_hr_saida).",              
							".$this->Db->qstr($v_dt_chegada).",            
							".$this->Db->qstr($v_hr_chegada).",           
							".$this->Db->qstr($v_localizador).",           
							".$this->Db->qstr($v_etkt).",                  
							".$this->Db->qstr($v_emitida_bvt).",           
							".$this->Db->qstr($v_bloqueio).",              
							".$this->Db->qstr($v_dbloqueio).",             
							".$this->Db->qstr($v_modificado_em).",         
							".$this->Db->qstr($v_ativo).",                 
							".$this->Db->qstr($v_pax_gate).",              
							".$this->Db->qstr($v_nota_gate).",             
							".$this->Db->qstr($v_dt_nota_gate).",         
							".$this->Db->qstr($vp_usuario).",
							".$this->Db->qstr($v_tipoPessoa).",
							".$this->Db->qstr($_usado_bloqueio).",
							".$this->Db->qstr($_total_bloq).",
							".$this->Db->qstr($_sentido).")						
						";	
						
     $nm_select = $sqli2; 
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
			}
			$ret = 'ADICIONA OK2';	
		} else {
			$ret = 'ADICIONA ERRO2';	
		}				
		return $ret;
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepRelAereo($evento,$vp_usuario,$vp_tipo,$vp_nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		
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
					evento_id = ".$this->Db->qstr($evento)."
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
	
		if ($vp_tipo == 'P') {
			$sqld="
			DELETE FROM 
				aereopar_rsvp_r 
			WHERE   
				id_evento = ".$this->Db->qstr($evento)."
			AND 
				id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
			";	
		}
		
		$sql="
		SELECT
    		id_evento,
  			id_usuario_relato
		FROM
   			aereopar_rsvp_r 
		WHERE   
			id_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($$vp_usuario)."
		ORDER BY 
			id_evento,
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
	
		$reg_subs = sizeof($rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {						
			if($vp_nivel == 'CONVIDADO') {
				$sqlj = "
				SELECT 
					aereos_rsvp.aereo_id_evento AS a_evento,
					aereos_rsvp.aereo_id_usuario AS a_usuario,
					usuarios_rsvp.usuario_nome AS usuario_nome,
					aereos_rsvp.aereo_cpf_particip AS a_cpf,
					participantes_rsvp.nome_pessoa AS participante_nome, 
					CASE aereos_rsvp.aereo_status 
						WHEN 'Y' THEN 'CONFIRMADO'
						WHEN 'A' THEN 'ABERTO'
						WHEN 'P' THEN 'PENDENTE'
						WHEN 'N' THEN 'NÃO CONFIRMADO'
					END
					AS a_status,
					aereos_rsvp.aereo_direcao AS a_direcao,
					aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
					tbl_cia_aereas.cia_nome AS cia_aerea,
					aereos_rsvp.aereo_num_voo AS a_voo,
					CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
					CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
					aereos_rsvp.aereo_dt_saida AS a_dt_saida,
					aereos_rsvp.aereo_hr_saida AS a_hr_saida,
					aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
					aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
					aereos_rsvp.aereo_localizador AS a_localizador,
					aereos_rsvp.aereo_eticket AS a_etkt,				
					IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
					aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
					bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
					aereos_rsvp.aereo_modificado_em AS a_modificado_em,
					aereos_rsvp.aereo_ativo AS a_ativo,
					aereos_rsvp.nome_pax_gate AS a_pax_gate,
					aereos_rsvp.nota_gate AS a_nota_gate,
					aereos_rsvp.data_nota_gate AS a_dt_nota_gate,
					participantes_rsvp.part_id_evento_publico,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					aereos_rsvp
				INNER JOIN 	
					usuarios_rsvp
				ON	
					usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
				INNER JOIN 	
					participantes_rsvp
				ON
					participantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
				INNER JOIN
					tbl_cia_aereas
				ON
					tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
				INNER JOIN
					aeroporto AS orig				
				ON
					aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
				INNER JOIN
					aeroporto AS dest		
				ON		 
					aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
				LEFT JOIN
					bloqueio_aereo_rsvp	
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
				WHERE
					aereos_rsvp.aereo_ativo = ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
				AND
					aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
				AND
					aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
				AND			  
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY
					aereos_rsvp.aereo_cpf_particip,
					aereos_rsvp.aereo_dthr_saida,
					aereos_rsvp.aereo_direcao				
				";
			} else {
				$sqlj = "
				SELECT 
					aereos_rsvp.aereo_id_evento AS a_evento,
					aereos_rsvp.aereo_id_usuario AS a_usuario,
					usuarios_rsvp.usuario_nome AS usuario_nome,
					aereos_rsvp.aereo_cpf_particip AS a_cpf,
					participantes_rsvp.nome_pessoa AS participante_nome, 
					CASE aereos_rsvp.aereo_status 
						WHEN 'Y' THEN 'CONFIRMADO'
						WHEN 'A' THEN 'ABERTO'
						WHEN 'P' THEN 'PENDENTE'
						WHEN 'N' THEN 'NÃO CONFIRMADO'
					END
					AS a_status,
					aereos_rsvp.aereo_direcao AS a_direcao,
					aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
					tbl_cia_aereas.cia_nome AS cia_aerea,
					aereos_rsvp.aereo_num_voo AS a_voo,
					CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
					CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
					aereos_rsvp.aereo_dt_saida AS a_dt_saida,
					aereos_rsvp.aereo_hr_saida AS a_hr_saida,
					aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
					aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
					aereos_rsvp.aereo_localizador AS a_localizador,
					aereos_rsvp.aereo_eticket AS a_etkt,				
					IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
					aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
					bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
					aereos_rsvp.aereo_modificado_em AS a_modificado_em,
					aereos_rsvp.aereo_ativo AS a_ativo,
					aereos_rsvp.nome_pax_gate AS a_pax_gate,
					aereos_rsvp.nota_gate AS a_nota_gate,
					aereos_rsvp.data_nota_gate AS a_dt_nota_gate,
					participantes_rsvp.part_id_evento_publico,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					aereos_rsvp
				INNER JOIN 	
					usuarios_rsvp
				ON	
					usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
				INNER JOIN 	
					participantes_rsvp
				ON
					participantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
				INNER JOIN
					tbl_cia_aereas
				ON
					tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
				INNER JOIN
					aeroporto AS orig				
				ON
					aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
				INNER JOIN
					aeroporto AS dest		
				ON		 
					aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
				LEFT JOIN
					bloqueio_aereo_rsvp	
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
				WHERE
					aereos_rsvp.aereo_ativo = ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
				AND
					aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
				AND
					aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
				AND			  
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				ORDER BY
					aereos_rsvp.aereo_cpf_particip,
					aereos_rsvp.aereo_dthr_saida,
					aereos_rsvp.aereo_direcao				
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
					$v_evento				= $rsj[$i][0]; 	
					$v_usuario				= $rsj[$i][1];		
					$v_usuario_nome			= $rsj[$i][2]; 	
					$v_cpf					= $rsj[$i][3]; 	
					$v_participante_nome	= $rsj[$i][4]; 	
					$v_status				= $rsj[$i][5]; 	
					$v_direcao				= $rsj[$i][6]; 	
					$v_cod_cia_aerea		= $rsj[$i][7]; 	
					$v_cia_aerea			= $rsj[$i][8]; 	
					$v_voo					= $rsj[$i][9];		
					$v_origem				= $rsj[$i][10]; 	
					$v_destino				= $rsj[$i][11];	
					$v_dt_saida				= $rsj[$i][12];	
					$v_hr_saida				= $rsj[$i][13];	
					$v_dt_chegada			= $rsj[$i][14];	
					$v_hr_chegada			= $rsj[$i][15];	
					$v_localizador			= $rsj[$i][16];	
					$v_etkt					= $rsj[$i][17];	
					$v_emitida_bvt			= $rsj[$i][18];	
					$v_bloqueio				= $rsj[$i][19];	
					$v_dbloqueio			= $rsj[$i][20];	
					$v_modificado_em		= $rsj[$i][21];	
					$v_ativo				= $rsj[$i][22];	
					$v_pax_gate				= $rsj[$i][23];	
					$v_nota_gate			= $rsj[$i][24];	
					$v_dt_nota_gate			= $rsj[$i][25];	
					
					$v_publico_id			= $rsj[$i][26];							
					
					$v_tipoPessoa			= "PARTICIPANTE";
					$reg_count = 1;	
					$sqlc = "						
					SELECT 
						aereopar_rsvp_r.id_evento, 
						aereopar_rsvp_r.participante_cpf,
						aereopar_rsvp_r.direcao,
						aereopar_rsvp_r.cod_cia_aerea,
						aereopar_rsvp_r.origem,
						aereopar_rsvp_r.voo,
						aereopar_rsvp_r.hora_saida,
						aereopar_rsvp_r.data_saida	
					FROM 
						aereopar_rsvp_r 
					WHERE 
						aereopar_rsvp_r.id_evento = ".$this->Db->qstr($v_evento)." 
					AND 
						aereopar_rsvp_r.participante_cpf = ".$this->Db->qstr($v_cpf)." 
					AND
						aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)." 
					AND
						aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)." 
					AND
						aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)." 
					AND
						aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)." 
					AND	
						aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)." 
					AND	
						aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)." 
					AND
						aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
					";							
					 
      $nm_select = $sqlc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsc = false;
          $rsc_erro = $this->Db->ErrorMsg();
      } 
	
					if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

					$reg_count = sizeof($rsc );							
					if ($reg_count == 0) {
																		
						if($v_bloqueio <> '0') {
							
							$_usado_bloqueio = '1';
							$sqlbs="
							SELECT 
								bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
							FROM
								bloqueio_aereo_rsvp
							WHERE
								bloqueio_id = ".$this->Db->qstr($v_bloqueio)." 
							AND
								bloq_evento_id = ".$this->Db->qstr($evento)." 
							ORDER BY
								bloqueio_id,bloq_evento_id
							";							
							 
      $nm_select = $sqlbs; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsbs = false;
          $rsbs_erro = $this->Db->ErrorMsg();
      } 
	
							if (isset($rsbs[0][0])) {	
								$_sentido 	= $rsbs[0][2];									
								$_total_bloq = $rsbs[0][3];									
							}		
								
						} else {
							$_sentido	= '';															
							$_total_bloq = '0';								
							$_usado_bloqueio = '0';
						}		
						
						$sqlpa = "
							SELECT
								part_cpf,
								part_id_evento_publico
							FROM
								participantes_rsvp	
							WHERE
								part_cpf = ".$this->Db->qstr($v_cpf)."
							AND
								part_id_evento = ".$this->Db->qstr($v_evento)."
						";	
						 
      $nm_select = $sqlpa; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspa = false;
          $rspa_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($rspa[0][0])) {	
							$v_publico_id = $rspa[0][1];
						}	
						$sqlpub ="
							SELECT
								publico_id,
								publico_nome
							FROM 
								publico_rsvp
							WHERE
								publico_id = ".$this->Db->qstr($v_publico_id)."
						";
						 
      $nm_select = $sqlpub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspb = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspb[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspb = false;
          $rspb_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($rspb[0][0])) {	
							$v_publico_dsc = $rspb[0][1];									
						} else {
							$v_publico_dsc = '';
						}	
						$sqlins = "
							SELECT 
								COUNT(p_cpf) as qtde
							FROM 
								aereopar_rsvp_r
							WHERE 
								participante_cpf = ".$this->Db->qstr($v_cpf)." 
							AND 
								id_evento = ".$this->Db->qstr($v_evento)."  
							AND
								aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)." 
							AND
								aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."  
							AND
								aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)."  
							AND
								aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)." 
							AND	
								aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)." 
							AND	
								aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)." 
							AND
								aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
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
								aereopar_rsvp_r  
								(id_evento,
								id_usuario,
								usuario_nome,
								participante_cpf,
								participante_nome,
								satus,
								direcao,
								cod_cia_aerea,
								cia_aerea,
								voo,
								origem,
								destino,
								data_saida,
								hora_saida,
								data_chegada,
								hora_chegada,
								localizador,
								etkt,	
								emitida_bvt,
								bloqueio,
								bloqueio_dsc,
								modificado_em,
								ativo,
								pax_gate,
								nota_gate,
								data_nota_gate,							
								id_usuario_relato,
								tipo_pessoa,
								usado_bloqueio,
								total_bloqueio,
								publico,
								direcao_bloqueio)	
							VALUES
								(".$this->Db->qstr($v_evento).", 				 
								".$this->Db->qstr($v_usuario).",               
								".$this->Db->qstr($v_usuario_nome).",         
								".$this->Db->qstr($v_cpf).",                
								".$this->Db->qstr($v_participante_nome).",     
								".$this->Db->qstr($v_status).",                       
								".$this->Db->qstr($v_direcao).",               
								".$this->Db->qstr($v_cod_cia_aerea).",         
								".$this->Db->qstr($v_cia_aerea).",             
								".$this->Db->qstr($v_voo).",                   
								".$this->Db->qstr($v_origem).",               
								".$this->Db->qstr($v_destino).",               
								".$this->Db->qstr($v_dt_saida).",              
								".$this->Db->qstr($v_hr_saida).",              
								".$this->Db->qstr($v_dt_chegada).",            
								".$this->Db->qstr($v_hr_chegada).",           
								".$this->Db->qstr($v_localizador).",           
								".$this->Db->qstr($v_etkt).",                  
								".$this->Db->qstr($v_emitida_bvt).",           
								".$this->Db->qstr($v_bloqueio).",              
								".$this->Db->qstr($v_dbloqueio).",             
								".$this->Db->qstr($v_modificado_em).",         
								".$this->Db->qstr($v_ativo).",                 
								".$this->Db->qstr($v_pax_gate).",              
								".$this->Db->qstr($v_nota_gate).",             
								".$this->Db->qstr($v_dt_nota_gate).",         
								".$this->Db->qstr($vp_usuario).",																
								".$this->Db->qstr($v_tipoPessoa).",
								".$this->Db->qstr($_usado_bloqueio).",
								".$this->Db->qstr($_total_bloq).",
								".$this->Db->qstr($v_publico_dsc).",
								".$this->Db->qstr($_sentido).")	       							
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
					}
					$ret = 'ADICIONA OK';	
				} else {
					$ret = 'ADICIONA ERRO';	
				}			
		}
		return $ret;
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepRelRsvp2($evento,$usuario) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}

}

?>
