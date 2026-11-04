<?php
class grid_aereos_rsvp_lookup
{
//  
   function lookup_aereo_cia_aerea(&$conteudo , $aereo_cia_aerea) 
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
      if (trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;" || trim($aereo_cia_aerea) === "" || trim($aereo_cia_aerea) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome, cia_sigla" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(cia_nome,' - ', cia_sigla)  FROM tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome, cia_sigla" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT cia_nome&' - '&cia_sigla  FROM tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome, cia_sigla" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome, cia_sigla" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome, cia_sigla" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome, cia_sigla" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas where cia_id = $aereo_cia_aerea order by cia_nome, cia_sigla" ; 
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
   function lookup_aereo_origem(&$conteudo , $aereo_origem) 
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
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT SIGLA + '  ' + NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(SIGLA,'  ', NOM_CIDADE)  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT SIGLA&'  '&NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT SIGLA||'  '||NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT SIGLA + '  ' + NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT SIGLA||'  '||NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT SIGLA||'  '||NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_origem), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
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
   function lookup_aereo_destino(&$conteudo , $aereo_destino) 
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
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT SIGLA + '  ' + NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(SIGLA,'  ', NOM_CIDADE)  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT SIGLA&'  '&NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT SIGLA||'  '||NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT SIGLA + '  ' + NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT SIGLA||'  '||NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT SIGLA||'  '||NOM_CIDADE  FROM aeroporto where COD_AEROPORTO = '" . substr($this->Db->qstr($aereo_destino), 1 , -1) . "' order by SIGLA, NOM_CIDADE" ; 
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
}
?>
