<?php
class grid_inconsistmailling2_lookup
{
//  
   function lookup_tipo_correcao(&$conteudo , $cpf_correcao_planilha) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $cpf_correcao_planilha; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select tipo_documento from pessoas_rsvp where pessoa_cpf = '" . substr($this->Db->qstr($cpf_correcao_planilha), 1 , -1) . "' order by tipo_documento,pessoa_cpf" ; 
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
   function lookup_nomeevento(&$conteudo , $vg_evento_id, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      $conteudo = "";
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT 'Evento: ' + evento_id + ' -' + evento_nome  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat('Evento: ',evento_id,' -', evento_nome)  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT 'Evento: '&evento_id&' -'&evento_nome  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT 'Evento: '||evento_id||' -'||evento_nome  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT 'Evento: ' + evento_id + ' -' + evento_nome  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_id, evento_nome" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT 'Evento: '||evento_id||' -'||evento_nome  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_id, evento_nome" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT 'Evento: '||evento_id||' -'||evento_nome  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_id, evento_nome" ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          $x = 0; 
          $nm_tmp_campos_select = explode(",", "'Evento: ',evento_id,' -', evento_nome"); 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 if ($y == 1)
                 { 
                     $conteudo .= "<br>";
                     $y = 0; 
                     $x = 0; 
                 } 
                 $y++; 
                 if ($x != 0)
                 { 
                     $conteudo .= "";
                 } 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $nm_array_retorno_lookup[$a] [trim($nm_tmp_campos_select[$x])] = trim($rx->fields[$x]);
                        $nm_array_retorno_lookup[$a] [$x]= $rx->fields[$x];
                        if ($x != 0)
                        { 
                            $conteudo .= "&nbsp;";
                        } 
                        $conteudo .= $rx->fields[$x];
                 }
                 $a++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
   } 
}
?>
