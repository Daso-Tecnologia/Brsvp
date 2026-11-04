<?php
class chart_aereos_rsvp_lookup
{
//  
   function lookup_sc_free_group_by_aereo_id_evento(&$conteudo , $aereo_id_evento) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $aereo_id_evento; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($aereo_id_evento) === "" || trim($aereo_id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select evento_nome from eventos_rsvp where evento_id = $aereo_id_evento order by evento_nome" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_sc_free_group_by_aereo_cia_aerea(&$conteudo , $aereo_cia_aerea) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $aereo_cia_aerea; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select cia_nome from tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
   function lookup_res_aereo_id_evento_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "aereo_id_evento";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               $this->lookup_aereo_id_evento_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'aereo_id_evento_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
//  
   function lookup_aereo_id_evento_SC_1(&$conteudo , $aereo_id_evento) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $aereo_id_evento; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($aereo_id_evento) === "" || trim($aereo_id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select evento_nome from eventos_rsvp where evento_id = '$aereo_id_evento' order by evento_nome" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
   function lookup_res_aereo_cpf_particip_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "aereo_cpf_particip";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'aereo_cpf_particip_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
   function lookup_res_aereo_status_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "aereo_status";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               $this->lookup_aereo_status_SC_1($val_format);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'aereo_status_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
//  
   function lookup_aereo_status_SC_1(&$aereo_status_SC_1) 
   {
      $conteudo = "" ; 
      $aereo_status_SC_1_1 = explode(";", $aereo_status_SC_1) ;
      if (in_array("A", $aereo_status_SC_1_1))
      { 
          $conteudo .= "ABERTO" . " ";
      } 
      if (in_array("N", $aereo_status_SC_1_1))
      { 
          $conteudo .= "NÃO" . " ";
      } 
      if (in_array("P", $aereo_status_SC_1_1))
      { 
          $conteudo .= "PENDENTE" . " ";
      } 
      if (in_array("Y", $aereo_status_SC_1_1))
      { 
          $conteudo .= "SIM" . " ";
      } 
      if (!empty($conteudo)) 
      { 
          $aereo_status_SC_1 = $conteudo; 
      } 
   }  
   function lookup_res_aereo_direcao_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "aereo_direcao";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'aereo_direcao_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
   function lookup_res_aereo_cia_aerea_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "aereo_cia_aerea";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               $this->lookup_aereo_cia_aerea_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'aereo_cia_aerea_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
//  
   function lookup_aereo_cia_aerea_SC_1(&$conteudo , $aereo_cia_aerea) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $aereo_cia_aerea; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select cia_nome from tbl_cia_aereas where cia_id = '$aereo_cia_aerea' order by cia_nome" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
   function lookup_res_aereo_origem_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "aereo_origem";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               $this->lookup_aereo_origem_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'aereo_origem_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
//  
   function lookup_aereo_origem_SC_1(&$conteudo , $aereo_origem) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $aereo_origem; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select NOM_CIDADE from aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by NOM_CIDADE" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
   function lookup_res_aereo_destino_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "aereo_destino";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['where_res_lookup'];
       }
       $nm_comando .= " GROUP BY " .$campos_select . "";
       $nm_comando .= " order by " . $campos_select . "";
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
       if ($RSI = $this->Db->Execute($nm_comando))
       {
           while (!$RSI->EOF) 
           {
               $val_orig   = $RSI->fields[0];
               $val_format = $val_orig;
               $this->lookup_aereo_destino_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_aereos_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'aereo_destino_SC_1', 'opt' => $val_orig, 'value' => $val_format);
               $RSI->MoveNext() ;
           }
           $RSI->Close(); 
       }
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
       return $result;
   }
//  
   function lookup_aereo_destino_SC_1(&$conteudo , $aereo_destino) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $aereo_destino; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select NOM_CIDADE from aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by NOM_CIDADE" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
}
?>
