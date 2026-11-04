<?php
class grid_hospedagem_rsvp_lookup
{
//  
   function lookup_hosp_id_hotel(&$conteudo , $hosp_id_hotel) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $hosp_id_hotel; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($hosp_id_hotel) === "" || trim($hosp_id_hotel) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select hotel_fantasia from tbl_hoteis where hotel_id = $hosp_id_hotel order by hotel_fantasia" ; 
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
   function lookup_hosp_id_evento(&$conteudo , $hosp_id_evento) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $hosp_id_evento; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;" || trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT evento_id + ' - ' + evento_nome  FROM eventos_rsvp where evento_id = $hosp_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(evento_id,' - ',evento_nome)  FROM eventos_rsvp where evento_id = $hosp_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT evento_id&' - '&evento_nome  FROM eventos_rsvp where evento_id = $hosp_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT evento_id||' - '||evento_nome  FROM eventos_rsvp where evento_id = $hosp_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT convert(char,evento_id) + ' - ' + evento_nome  FROM eventos_rsvp where evento_id = $hosp_id_evento order by evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT char(evento_id)||' - '||evento_nome  FROM eventos_rsvp where evento_id = $hosp_id_evento order by evento_id, evento_nome" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT evento_id||' - '||evento_nome  FROM eventos_rsvp where evento_id = $hosp_id_evento order by evento_id, evento_nome" ; 
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
   function lookup_hosp_id_usuario(&$conteudo , $hosp_id_usuario) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $hosp_id_usuario; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($hosp_id_usuario) === "" || trim($hosp_id_usuario) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select usuario_nome from usuarios_rsvp where usuario_id = '$hosp_id_usuario' order by usuario_nome" ; 
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
