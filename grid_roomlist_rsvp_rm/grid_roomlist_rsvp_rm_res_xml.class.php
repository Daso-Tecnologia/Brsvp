<?php

class grid_roomlist_rsvp_rm_res_xml
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_res_grid']))
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
      $this->Arq_zip       = $this->Arquivo . "_grid_roomlist_rsvp_rm.zip";
      $this->Arquivo      .= "_grid_roomlist_rsvp_rm";
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_res_grid']))
      {
          $this->Arquivo      .= "_" . $this->Ini->Nm_lang['lang_othr_smry_titl'];
      }
      $this->Arquivo_view  = $this->Arquivo . "_view.xml";
      $this->Arquivo      .= ".xml";
      $this->Tit_doc       = "grid_roomlist_rsvp_rm.xml";
      $this->Tit_zip       = "grid_roomlist_rsvp_rm.zip";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->Res       = new grid_roomlist_rsvp_rm_resumo("out");
      $this->prep_modulos("Res");
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_res_grid']) && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_return']);
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
          fwrite($xml_f, "<grid_roomlist_rsvp_rm>\r\n");
      }
      if ($this->Grava_view)
      {
          $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
          $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
          fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
          fwrite($xml_v, "<root>\r\n");
          if ($this->New_Format)
          {
              fwrite($xml_v, "<grid_roomlist_rsvp_rm>\r\n");
          }
      }
      $this->Res->resumo_export();
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_res_grid']) && !$this->Ini->sc_export_ajax) {
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
      $this->array_titulos = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['arr_export']['label'];
      $this->array_linhas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['arr_export']['data'];
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
          fwrite($xml_f, "</grid_roomlist_rsvp_rm>\r\n");
      }
      fwrite($xml_f, "</root>");
      fclose($xml_f);
      if ($this->Grava_view)
      {
          $this->grava_linha($xml_v);
          if ($this->New_Format)
          {
              fwrite($xml_v, "</grid_roomlist_rsvp_rm>\r\n");
          }
          fwrite($xml_v, "</root>");
          fclose($xml_v);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_res_grid']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_res_file']['xml'] = $this->Xml_f;
          if ($this->Grava_view)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_res_file']['view'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
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
              $xml_registro = "<grid_roomlist_rsvp_rm";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> roomlist_rsvp_r :: XML</TITLE>
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
<form name="Fdown" method="get" action="grid_roomlist_rsvp_rm_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_roomlist_rsvp_rm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['xml_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function PrepRoom2($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';	
		$valor_y = 'Y';
		$valor_s = 'SIM';
		$valor_n = 'N';		
		
		if ($vp_tipoPessoa == 'P') {                                                                                      
			$sqld="                                                                                                          
			DELETE FROM                                                                                                      
				roomlist_rsvp_r
			WHERE                                                                                                            
				cod_evento = ".$this->Db->qstr($vp_evento)."                                                                                    
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
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			transfer_rsvp.tra_numvoo_ida,	                
			transfer_rsvp.tra_cia_ida,   		  
			transfer_rsvp.tra_hr_chegada_ida,
			transfer_rsvp.tra_numvoo_volta,                 
			transfer_rsvp.tra_cia_volta,		            
			transfer_rsvp.tra_hr_saida_volta, 	            
			transfer_rsvp.tra_hrtransout,		            
			transfer_rsvp.tra_tipo,	
			transfer_rsvp.tra_direcao,	
			transfer_rsvp.tra_id_hotel,
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		RIGHT JOIN
			transfer_rsvp
		ON
			transfer_rsvp.tra_cpf_particip = hospedagem_rsvp.hosp_cpf_participante		
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)." 	
		AND
			hospedagem_rsvp.conta_roomlist = ".$this->Db->qstr($valor_s)." 
		AND
			transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)." 
		AND
			transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."						
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;			                                                                                          
		 
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
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';								
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				
				$w_hosp_cpf_participante	= $rsm[$i][0];		
				$w_hosp_id_evento		    = $rsm[$i][1];     
				$w_hosp_acompanhante	    = $rsm[$i][2];     
				$w_hosp_part_acomp     	    = $rsm[$i][3];     
				$w_hosp_id_hotel		    = $rsm[$i][4];     
				$w_hosp_acomodacao		 	= $rsm[$i][5];     
				$w_hosp_categoria  		    = $rsm[$i][6];     
				$w_hosp_dt_checkin		 	= $rsm[$i][7];     
				$w_hosp_dt_checkout   	 	= $rsm[$i][8];     
				$w_hosp_early_chkin  	    = $rsm[$i][9];     
				$w_hosp_late_chkout 	    = $rsm[$i][10];    
				$w_hosp_pagamentos 		    = $rsm[$i][11];    
				$w_hosp_observacoes		    = $rsm[$i][12];    
				$w_hosp_dsc_pacote          = $rsm[$i][13];    
				$w_tra_numvoo_ida	        = $rsm[$i][14];	
				$w_tra_cia_ida   		    = $rsm[$i][15];	
				$w_tra_hr_saida_ida         = $rsm[$i][16];	
				$w_tra_numvoo_volta         = $rsm[$i][17];	
				$w_tra_cia_volta		    = $rsm[$i][18];	
				$w_tra_hr_saida_volta 	  	= $rsm[$i][19];    
				$w_tra_hrtransout		    = $rsm[$i][20];	
				$w_tra_tipotransfer			= $rsm[$i][21];    
				$f_tra_direcao				= $rsm[$i][22];	
				$f_tra_id_hotel				= $rsm[$i][23];    
				$w_hosp_acmq_01				= $rsm[$i][24];	
				$w_hosp_acmq_02				= $rsm[$i][25];    
				$w_hosp_acmq_03				= $rsm[$i][26];    
				$w_hosp_acmq_04				= $rsm[$i][27];    
				$w_hosp_pamq_01				= $rsm[$i][28];    
				$w_hosp_pamq_02				= $rsm[$i][29];    
				$w_hosp_pamq_03				= $rsm[$i][30];    
				$w_hosp_pamq_04				= $rsm[$i][31];	

				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspart[0][0])) {											
					$w_nome				   		= $rspart[0][0];			  	             
					$w_part_passaporte     		= $rspart[0][1];    	     
					$w_part_rg             		= $rspart[0][2];    	
					$w_part_dt_nasc        		= $rspart[0][3];  	
					$w_part_ddd_celular_01 		= $rspart[0][4];  	      
					$w_part_celeular_01      	= $rspart[0][5]; 
					$w_part_email            	= $rspart[0][6];    
					$w_part_id_evento_publico	= $rspart[0][7];   
					$w_empresa					= $rspart[0][9];
					$w_grupo					= $rspart[0][10];
					$w_cargo					= $rspart[0][11];
					$w_tipopess 				= 'PARTICIPANTE';
					$w_foneinter				= $rspart[0][12];
					$w_dsc_emp_rsvp				= $rspart[0][13];					
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."			
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspart[0][0])) {											
						$w_nome				   		= $rspart[0][0];			  	             
						$w_part_passaporte     		= $rspart[0][1];    	     
						$w_part_rg             		= $rspart[0][2];    	
						$w_part_dt_nasc        		= $rspart[0][3];  	
						$w_part_ddd_celular_01 		= $rspart[0][4];  	      
						$w_part_celeular_01      	= $rspart[0][5]; 
						$w_part_email            	= $rspart[0][6];    
						$w_part_id_evento_publico	= $rspart[0][7];  
						$w_empresa					= $rspart[0][9];
						$w_grupo					= $rspart[0][10];
						$w_cargo					= $rspart[0][11];
						$w_tipopess 				= 'ACOMPANHANTE';
						$w_foneinter				= $rspart[0][12];
						$w_dsc_emp_rsvp				= $rspart[0][13];
					}					
				}		
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
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
				switch($w_tra_tipotransfer) {                                                                                      
					case 'A':                                                                                                      
						$w_tra_tipotransfer = 'AEREO';  		                                                                               
						break;                                                                                                        
					case 'L':                                                                                                      
						$w_tra_tipotransfer	= 'LOCAL';                                                                                   
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_tra_tipotransfer	= 'PROPRIO';                                                                                 
						break;	                                                                                                       
				}                                                                                                              
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
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
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspgt = false;
          $rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($w_tra_cia_ida)."                                                                                 
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
					$w_ciaida = $rscia[0][1];                                                                                  
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
					cia_id = ".$this->Db->qstr($w_tra_cia_volta)."                                                                                 
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
					$w_ciavolta = $rscia[0][1];                                                                                  
				} else {                                                                                                        
					$w_ciavolta = "";				                                                                                         
				}					
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaco = false;
          $rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsaco[0][0])) {									                                                                            
					$w_acomodacao = $rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscat = false;
          $rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rscat[0][0])) {									                                                                            
					$w_categoria = $rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
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
					$w_publico = $rspub[0][1];                                                                                  
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
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
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
					$w_hotel_dsc = $rshot[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc = "";				                                                                                         
				}					
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsanot = false;
          $rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsanot[0][0])) {
					$w_anotacao = $rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				$w_acompanhado = "";
				if ($w_tipopess  == 'ACOMPANHANTE') {						
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspacm = false;
          $rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspcpf = false;
          $rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}					
				     				
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_01		= $rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $rsplhac[0][2];
						$w_acmq_rg_01		= $rsplhac[0][3];
						$w_acmq_docest_01	= $rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_02		= $rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $rsplhac[0][2];
						$w_acmq_rg_02		= $rsplhac[0][3];
						$w_acmq_docest_02	= $rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_03		= $rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $rsplhac[0][2];
						$w_acmq_rg_03		= $rsplhac[0][3];
						$w_acmq_docest_03	= $rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_04		= $rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $rsplhac[0][2];
						$w_acmq_rg_04		= $rsplhac[0][3];
						$w_acmq_docest_04	= $rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_01		= $rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $rsplhac[0][2];
						$w_pamq_rg_01		= $rsplhac[0][3];
						$w_pamq_docest_01	= $rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_02		= $rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_02	= $rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_03		= $rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $rsplhac[0][2];
						$w_pamq_rg_03		= $rsplhac[0][3];
						$w_pamq_docest_03	= $rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_04		= $rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_04	= $rsplhac[0][4];				
					}										
				}	
				
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsnoinc = false;
          $rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				
				
				if ($inclui == 'S' && $w_nome <> '') {					
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($wW_pamq_dtnasc_04).",
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
						
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function PrepRoom3($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';
		$valor_y = 'Y';			                                                                                        
		$valor_s = 'SIM';
		$valor_n = 'N';
		$valor_exclui = 'ANHANTE';
		
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)."	
		AND
			hospedagem_rsvp.conta_roomlist= ".$this->Db->qstr($valor_s)."
		AND	
			hospedagem_rsvp.acmq_01 <> ".$this->Db->qstr($valor_exclui)."
		AND	
			hospedagem_rsvp.acmq_02 <> ".$this->Db->qstr($valor_exclui)."
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;
		 
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
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';				
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				 				
				$w_hosp_cpf_participante	= $rsm[$i][0];		     					                 
				$w_hosp_id_evento		    = $rsm[$i][1];               
				$w_hosp_acompanhante	    = $rsm[$i][2];            
				$w_hosp_part_acomp     	    = $rsm[$i][3];            
				$w_hosp_id_hotel		    = $rsm[$i][4];                  
				$w_hosp_acomodacao		 	= $rsm[$i][5];              
				$w_hosp_categoria  		    = $rsm[$i][6];              
				$w_hosp_dt_checkin		 	= $rsm[$i][7];            	   		
				$w_hosp_dt_checkout   	 	= $rsm[$i][8];           
				$w_hosp_early_chkin  	    = $rsm[$i][9];           
				$w_hosp_late_chkout 	    = $rsm[$i][10];           
				$w_hosp_pagamentos 		    = $rsm[$i][11];            
				$w_hosp_observacoes		    = $rsm[$i][12];             
				$w_hosp_dsc_pacote          = $rsm[$i][13];               
				$w_hosp_acmq_01				= $rsm[$i][14];	
				$w_hosp_acmq_02				= $rsm[$i][15];    
				$w_hosp_acmq_03				= $rsm[$i][16];    
				$w_hosp_acmq_04				= $rsm[$i][17];    
				$w_hosp_pamq_01				= $rsm[$i][18];    
				$w_hosp_pamq_02				= $rsm[$i][19];    
				$w_hosp_pamq_03				= $rsm[$i][20];    
				$w_hosp_pamq_04				= $rsm[$i][21];	  							
			
				$w_tra_numvoo_ida	        = '';	
				$w_tra_cia_ida   		    = '';	
				$w_tra_hr_saida_ida         = '';	
				$w_tra_numvoo_volta         = '';	
				$w_tra_cia_volta		    = '';	
				$w_tra_hr_saida_volta 	  	= '';   
				$w_tra_hrtransout		    = '';	
				$w_tra_tipotransfer			= '';   
				$f_tra_direcao				= '';	
				$f_tra_id_hotel				= '';   
				
				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."	
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspart[0][0])) {											
					$w_nome				   		= $rspart[0][0];			  	             
					$w_part_passaporte     		= $rspart[0][1];    	     
					$w_part_rg             		= $rspart[0][2];    	
					$w_part_dt_nasc        		= $rspart[0][3];  	
					$w_part_ddd_celular_01 		= $rspart[0][4];  	      
					$w_part_celeular_01      	= $rspart[0][5]; 
					$w_part_email            	= $rspart[0][6];    
					$w_part_id_evento_publico	= $rspart[0][7];   	
					$w_empresa					= $rspart[0][9]; 
					$w_grupo					= $rspart[0][10]; 
					$w_cargo					= $rspart[0][11]; 
					$w_tipopess = 'PARTICIPANTE';		
					$w_foneinter				= $rspart[0][12];
					$w_dsc_emp_rsvp				= $rspart[0][13];
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."		
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspart[0][0])) {											
						$w_nome				   		= $rspart[0][0];			  	             
						$w_part_passaporte     		= $rspart[0][1];    	     
						$w_part_rg             		= $rspart[0][2];    	
						$w_part_dt_nasc        		= $rspart[0][3];  	
						$w_part_ddd_celular_01 		= $rspart[0][4];  	      
						$w_part_celeular_01      	= $rspart[0][5]; 
						$w_part_email            	= $rspart[0][6];    
						$w_part_id_evento_publico	= $rspart[0][7]; 
						$w_empresa					= $rspart[0][9];
						$w_grupo					= $rspart[0][10]; 
						$w_cargo					= $rspart[0][11]; 
						$w_tipopess = 'ACOMPANHANTE';			
						$w_foneinter				= $rspart[0][12];
						$w_dsc_emp_rsvp				= $rspart[0][13];
					}	
				}	
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
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
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
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
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspgt = false;
          $rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaco = false;
          $rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsaco[0][0])) {									                                                                            
					$w_acomodacao = $rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscat = false;
          $rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rscat[0][0])) {									                                                                            
					$w_categoria = $rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
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
					$w_publico = $rspub[0][1];                                                                                  
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
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
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
					$w_hotel_dsc = $rshot[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc = "";				                                                                                         
				}					
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsanot = false;
          $rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsanot[0][0])) {
					$w_anotacao = $rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				
				$w_acompanhado = "";
				if ($w_tipopess == 'PARTICIPANTE') { 	 					
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspacm = false;
          $rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspcpf = false;
          $rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}				
								
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_01		= $rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $rsplhac[0][2];
						$w_acmq_rg_01		= $rsplhac[0][3];
						$w_acmq_docest_01	= $rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_02		= $rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $rsplhac[0][2];
						$w_acmq_rg_02		= $rsplhac[0][3];
						$w_acmq_docest_02	= $rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_03		= $rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $rsplhac[0][2];
						$w_acmq_rg_03		= $rsplhac[0][3];
						$w_acmq_docest_03	= $rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_04		= $rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $rsplhac[0][2];
						$w_acmq_rg_04		= $rsplhac[0][3];
						$w_acmq_docest_04	= $rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_01		= $rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $rsplhac[0][2];
						$w_pamq_rg_01		= $rsplhac[0][3];
						$w_pamq_docest_01	= $rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_02		= $rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_02	= $rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_03		= $rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $rsplhac[0][2];
						$w_pamq_rg_03		= $rsplhac[0][3];
						$w_pamq_docest_03	= $rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_04		= $rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_04	= $rsplhac[0][4];				
					}										
				}	
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."	
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."	
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsnoinc = false;
          $rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				if ($inclui == 'S' && $w_nome <> '') {	
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($w_pamq_dtnasc_04).",	
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
					
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}

}

?>
