<?php
class grid_participantes_rsvp_sf_lookup
{
//  
   function lookup_cabecalho(&$conteudo , $vg_evento_id, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      $conteudo = "";
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT 'Evento: ' + evento_nome + ' Cód: ' + evento_id  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat('Evento: ',evento_nome,' Cód: ', evento_id)  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT 'Evento: '&evento_nome&' Cód: '&evento_id  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT 'Evento: '||evento_nome||' Cód: '||evento_id  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT 'Evento: ' + evento_nome + ' Cód: ' + evento_id  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_nome, evento_id" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT 'Evento: '||evento_nome||' Cód: '||evento_id  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_nome, evento_id" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT 'Evento: '||evento_nome||' Cód: '||evento_id  FROM eventos_rsvp  WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "'  ORDER BY evento_nome, evento_id" ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          $x = 0; 
          $nm_tmp_campos_select = explode(",", "'Evento: ',evento_nome,' Cód: ', evento_id"); 
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
//  
   function lookup_nome_evento(&$conteudo , $vg_evento_id, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      $conteudo = "";
      $nm_comando = "SELECT evento_nome 
FROM eventos_rsvp 
WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "' 
ORDER BY evento_nome" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          while (!$rx->EOF) 
          { 
                 if (isset($rx->fields[0]))
                 { 
                     $nm_array_retorno_lookup[$a][0] = $rx->fields[0];
                     $a++; 
                     if ($y == 1)
                     { 
                          $conteudo .= "<br>";
                          $y = 0; 
                     } 
                     if ($y != 0)
                     { 
                          $conteudo .= "";
                     } 
                     $y++; 
                     $nm_tmp_form = $rx->fields[0]; 
                     $conteudo .= $nm_tmp_form;
                 } 
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
//  
   function lookup_nome_participante(&$conteudo , $part_cpf, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      $conteudo = "";
      $nm_comando = "SELECT pessoa_nome 
FROM pessoas_rsvp 
WHERE pessoa_cpf = '" . substr($this->Db->qstr($part_cpf), 1 , -1) . "' 
ORDER BY pessoa_nome" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          while (!$rx->EOF) 
          { 
                 if (isset($rx->fields[0]))
                 { 
                     $nm_array_retorno_lookup[$a][0] = $rx->fields[0];
                     $a++; 
                     if ($y == 1)
                     { 
                          $conteudo .= "<br>";
                          $y = 0; 
                     } 
                     if ($y != 0)
                     { 
                          $conteudo .= "";
                     } 
                     $y++; 
                     $nm_tmp_form = $rx->fields[0]; 
                     $conteudo .= $nm_tmp_form;
                 } 
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
