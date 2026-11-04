<?php
class grid_mailling_rsvp_lookup
{
//  
   function lookup_id_evento(&$conteudo , $id_evento) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $id_evento; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;" || trim($id_evento) === "" || trim($id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT evento_id + ' - ' + evento_nome  FROM eventos_rsvp where evento_id = $id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(evento_id,' - ', evento_nome)  FROM eventos_rsvp where evento_id = $id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT evento_id&' - '&evento_nome  FROM eventos_rsvp where evento_id = $id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT evento_id||' - '||evento_nome  FROM eventos_rsvp where evento_id = $id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,evento_id) + ' - ' + evento_nome  FROM eventos_rsvp where evento_id = $id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(evento_id)||' - '||evento_nome  FROM eventos_rsvp where evento_id = $id_evento order by evento_id, evento_nome" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT evento_id||' - '||evento_nome  FROM eventos_rsvp where evento_id = $id_evento order by evento_id, evento_nome" ; 
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
   function lookup_id_usuario(&$conteudo , $id_usuario) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $id_usuario; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;" || trim($id_usuario) === "" || trim($id_usuario) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT usuario_id + ' - ' + usuario_nome  FROM usuarios_rsvp where usuario_id = $id_usuario order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(usuario_id, ' - ',usuario_nome)  FROM usuarios_rsvp where usuario_id = $id_usuario order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT usuario_id&' - '&usuario_nome  FROM usuarios_rsvp where usuario_id = $id_usuario order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT usuario_id||' - '||usuario_nome  FROM usuarios_rsvp where usuario_id = $id_usuario order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,usuario_id) + ' - ' + usuario_nome  FROM usuarios_rsvp where usuario_id = $id_usuario order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(usuario_id)||' - '||usuario_nome  FROM usuarios_rsvp where usuario_id = $id_usuario order by usuario_id, usuario_nome" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT usuario_id||' - '||usuario_nome  FROM usuarios_rsvp where usuario_id = $id_usuario order by usuario_id, usuario_nome" ; 
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
   function lookup_id_publico(&$conteudo , $id_publico) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $id_publico; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;" || trim($id_publico) === "" || trim($id_publico) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT publico_id + ' - ' + publico_nome  FROM publico_rsvp where publico_id = $id_publico order by publico_id, publico_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(publico_id, ' - ',publico_nome)  FROM publico_rsvp where publico_id = $id_publico order by publico_id, publico_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT publico_id&' - '&publico_nome  FROM publico_rsvp where publico_id = $id_publico order by publico_id, publico_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT publico_id||' - '||publico_nome  FROM publico_rsvp where publico_id = $id_publico order by publico_id, publico_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,publico_id) + ' - ' + publico_nome  FROM publico_rsvp where publico_id = $id_publico order by publico_id, publico_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(publico_id)||' - '||publico_nome  FROM publico_rsvp where publico_id = $id_publico order by publico_id, publico_nome" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT publico_id||' - '||publico_nome  FROM publico_rsvp where publico_id = $id_publico order by publico_id, publico_nome" ; 
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
   function lookup_id_regional(&$conteudo , $id_regional) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $id_regional; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;" || trim($id_regional) === "" || trim($id_regional) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT regional_id + ' - ' + regional_dsc  FROM tbl_regionais where regional_id = $id_regional order by regional_id, regional_dsc" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(regional_id,' - ',regional_dsc)  FROM tbl_regionais where regional_id = $id_regional order by regional_id, regional_dsc" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT regional_id&' - '&regional_dsc  FROM tbl_regionais where regional_id = $id_regional order by regional_id, regional_dsc" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT regional_id||' - '||regional_dsc  FROM tbl_regionais where regional_id = $id_regional order by regional_id, regional_dsc" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,regional_id) + ' - ' + regional_dsc  FROM tbl_regionais where regional_id = $id_regional order by regional_id, regional_dsc" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(regional_id)||' - '||regional_dsc  FROM tbl_regionais where regional_id = $id_regional order by regional_id, regional_dsc" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT regional_id||' - '||regional_dsc  FROM tbl_regionais where regional_id = $id_regional order by regional_id, regional_dsc" ; 
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
