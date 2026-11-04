<?php
class grid_transfer_rsvp_lookup
{
//  
   function lookup_tra_id_evento(&$conteudo , $tra_id_evento) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $tra_id_evento; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;" || trim($tra_id_evento) === "" || trim($tra_id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT evento_id + ' - ' + evento_nome  FROM eventos_rsvp where evento_id = $tra_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(evento_id,' - ', evento_nome)  FROM eventos_rsvp where evento_id = $tra_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT evento_id&' - '&evento_nome  FROM eventos_rsvp where evento_id = $tra_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT evento_id||' - '||evento_nome  FROM eventos_rsvp where evento_id = $tra_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,evento_id) + ' - ' + evento_nome  FROM eventos_rsvp where evento_id = $tra_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(evento_id)||' - '||evento_nome  FROM eventos_rsvp where evento_id = $tra_id_evento order by evento_id, evento_nome" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT evento_id||' - '||evento_nome  FROM eventos_rsvp where evento_id = $tra_id_evento order by evento_id, evento_nome" ; 
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
   function lookup_tra_id_usuario(&$conteudo , $tra_id_usuario) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $tra_id_usuario; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;" || trim($tra_id_usuario) === "" || trim($tra_id_usuario) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT usuario_id + ' - ' + usuario_nome  FROM usuarios_rsvp where usuario_id = '$tra_id_usuario' order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(usuario_id,' - ',usuario_nome)  FROM usuarios_rsvp where usuario_id = '$tra_id_usuario' order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT usuario_id&' - '&usuario_nome  FROM usuarios_rsvp where usuario_id = '$tra_id_usuario' order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT usuario_id||' - '||usuario_nome  FROM usuarios_rsvp where usuario_id = '$tra_id_usuario' order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,usuario_id) + ' - ' + usuario_nome  FROM usuarios_rsvp where usuario_id = '$tra_id_usuario' order by usuario_id, usuario_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(usuario_id)||' - '||usuario_nome  FROM usuarios_rsvp where usuario_id = '$tra_id_usuario' order by usuario_id, usuario_nome" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT usuario_id||' - '||usuario_nome  FROM usuarios_rsvp where usuario_id = '$tra_id_usuario' order by usuario_id, usuario_nome" ; 
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
   function lookup_tra_id_hotel(&$conteudo , $tra_id_hotel) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $tra_id_hotel; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;" || trim($tra_id_hotel) === "" || trim($tra_id_hotel) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT hotel_id + ' - ' + hotel_fantasia  FROM tbl_hoteis where hotel_id = $tra_id_hotel order by hotel_id, hotel_fantasia" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(hotel_id,' - ',hotel_fantasia)  FROM tbl_hoteis where hotel_id = $tra_id_hotel order by hotel_id, hotel_fantasia" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT hotel_id&' - '&hotel_fantasia  FROM tbl_hoteis where hotel_id = $tra_id_hotel order by hotel_id, hotel_fantasia" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT hotel_id||' - '||hotel_fantasia  FROM tbl_hoteis where hotel_id = $tra_id_hotel order by hotel_id, hotel_fantasia" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,hotel_id) + ' - ' + hotel_fantasia  FROM tbl_hoteis where hotel_id = $tra_id_hotel order by hotel_id, hotel_fantasia" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(hotel_id)||' - '||hotel_fantasia  FROM tbl_hoteis where hotel_id = $tra_id_hotel order by hotel_id, hotel_fantasia" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT hotel_id||' - '||hotel_fantasia  FROM tbl_hoteis where hotel_id = $tra_id_hotel order by hotel_id, hotel_fantasia" ; 
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
   function lookup_tra_id_bloqueio(&$conteudo , $tra_id_bloqueio) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $tra_id_bloqueio; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;" || trim($tra_id_bloqueio) === "" || trim($tra_id_bloqueio) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT bloq_evento_id + ' - ' + bloq_descricao  FROM bloqueio_aereo_rsvp where bloqueio_id = $tra_id_bloqueio order by bloq_evento_id, bloq_descricao" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(bloq_evento_id,' - ', bloq_descricao)  FROM bloqueio_aereo_rsvp where bloqueio_id = $tra_id_bloqueio order by bloq_evento_id, bloq_descricao" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT bloq_evento_id&' - '&bloq_descricao  FROM bloqueio_aereo_rsvp where bloqueio_id = $tra_id_bloqueio order by bloq_evento_id, bloq_descricao" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT bloq_evento_id||' - '||bloq_descricao  FROM bloqueio_aereo_rsvp where bloqueio_id = $tra_id_bloqueio order by bloq_evento_id, bloq_descricao" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,bloq_evento_id) + ' - ' + bloq_descricao  FROM bloqueio_aereo_rsvp where bloqueio_id = $tra_id_bloqueio order by bloq_evento_id, bloq_descricao" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(bloq_evento_id)||' - '||bloq_descricao  FROM bloqueio_aereo_rsvp where bloqueio_id = $tra_id_bloqueio order by bloq_evento_id, bloq_descricao" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT bloq_evento_id||' - '||bloq_descricao  FROM bloqueio_aereo_rsvp where bloqueio_id = $tra_id_bloqueio order by bloq_evento_id, bloq_descricao" ; 
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
