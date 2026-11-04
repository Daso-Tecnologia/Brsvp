<?php
class chart_participantes_rsvp_lookup
{
//  
   function lookup_sc_free_group_by_part_id_evento(&$conteudo , $part_id_evento) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $part_id_evento; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;" || trim($part_id_evento) === "" || trim($part_id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT evento_nome + ' - ' + evento_id  FROM eventos_rsvp where evento_id = $part_id_evento order by evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(evento_nome,' - ', evento_id)  FROM eventos_rsvp where evento_id = $part_id_evento order by evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT evento_nome&' - '&evento_id  FROM eventos_rsvp where evento_id = $part_id_evento order by evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT evento_nome||' - '||evento_id  FROM eventos_rsvp where evento_id = $part_id_evento order by evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT evento_nome + ' - ' + evento_id  FROM eventos_rsvp where evento_id = $part_id_evento order by evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT evento_nome||' - '||evento_id  FROM eventos_rsvp where evento_id = $part_id_evento order by evento_nome, evento_id" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT evento_nome||' - '||evento_id  FROM eventos_rsvp where evento_id = $part_id_evento order by evento_nome, evento_id" ; 
      } 
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
   function lookup_sc_free_group_by_part_id_evento_publico(&$conteudo , $part_id_evento_publico) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $part_id_evento_publico; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($part_id_evento_publico) === "" || trim($part_id_evento_publico) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select publico_nome from publico_rsvp where publico_id = $part_id_evento_publico order by publico_nome" ; 
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
   function lookup_sc_free_group_by_part_id_evento_regional(&$conteudo , $part_id_evento_regional) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $part_id_evento_regional; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($part_id_evento_regional) === "" || trim($part_id_evento_regional) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select regional_dsc from tbl_regionais where regional_id = $part_id_evento_regional order by regional_dsc" ; 
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
   function lookup_res_part_sexo_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "part_sexo";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               $this->lookup_part_sexo_SC_1($val_format);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'part_sexo_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_part_sexo_SC_1(&$part_sexo_SC_1) 
   {
      $conteudo = "" ; 
      $part_sexo_SC_1_1 = explode(";", $part_sexo_SC_1) ;
      if (in_array("Feminino", $part_sexo_SC_1_1))
      { 
          $conteudo .= "F" . " ";
      } 
      if (in_array("Masculino", $part_sexo_SC_1_1))
      { 
          $conteudo .= "M" . " ";
      } 
      if (!empty($conteudo)) 
      { 
          $part_sexo_SC_1 = $conteudo; 
      } 
   }  
   function lookup_res_part_cpf_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "part_cpf";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'part_cpf_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_res_nome_pessoa_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "nome_pessoa";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'nome_pessoa_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_res_part_id_evento_publico_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "part_id_evento_publico";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               $this->lookup_part_id_evento_publico_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'part_id_evento_publico_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_part_id_evento_publico_SC_1(&$conteudo , $part_id_evento_publico) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $part_id_evento_publico; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($part_id_evento_publico) === "" || trim($part_id_evento_publico) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select publico_nome from publico_rsvp where publico_id = '$part_id_evento_publico' order by publico_nome" ; 
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
   function lookup_res_part_id_evento_regional_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "part_id_evento_regional";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               $this->lookup_part_id_evento_regional_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'part_id_evento_regional_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_part_id_evento_regional_SC_1(&$conteudo , $part_id_evento_regional) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $part_id_evento_regional; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($part_id_evento_regional) === "" || trim($part_id_evento_regional) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select regional_dsc from tbl_regionais where regional_id = '$part_id_evento_regional' order by regional_dsc" ; 
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
   function lookup_res_part_empresa_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "part_empresa";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'part_empresa_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_res_part_cidade_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "part_cidade";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'part_cidade_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_res_part_presenca_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "part_presenca";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['where_res_lookup'];
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
               $this->lookup_part_presenca_SC_1($val_format);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_participantes_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'part_presenca_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_part_presenca_SC_1(&$part_presenca_SC_1) 
   {
      $conteudo = "" ; 
      $part_presenca_SC_1_1 = explode(";", $part_presenca_SC_1) ;
      if (in_array("A", $part_presenca_SC_1_1))
      { 
          $conteudo .= "ABERTO" . " ";
      } 
      if (in_array("N", $part_presenca_SC_1_1))
      { 
          $conteudo .= "NÃO" . " ";
      } 
      if (in_array("P", $part_presenca_SC_1_1))
      { 
          $conteudo .= "PENDENTE" . " ";
      } 
      if (in_array("Y", $part_presenca_SC_1_1))
      { 
          $conteudo .= "SIM" . " ";
      } 
      if (!empty($conteudo)) 
      { 
          $part_presenca_SC_1 = $conteudo; 
      } 
   }  
}
?>
