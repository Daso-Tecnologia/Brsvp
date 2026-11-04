<?php
class grid_participantes_rsvp_env_lookup
{
//  
   function lookup_dsc_evento(&$conteudo , $vg_evento_id, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      $conteudo = "";
      $nm_comando = "SELECT evento_id, evento_nome
FROM eventos_rsvp 
WHERE evento_id = '" . $_SESSION['vg_evento_id'] . "' 
ORDER BY evento_nome" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          $x = 0; 
          $nm_tmp_campos_select = explode(",", "evento_id, evento_nome"); 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 $rx->fields[0] = str_replace(',', '.', $rx->fields[0]); 
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
   function lookup_dsc_publico(&$conteudo , $part_id_evento_publico, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      if (trim($part_id_evento_publico) === "")
      { 
          $conteudo = "&nbsp;";
          return ; 
      } 
      $conteudo = "";
      $nm_comando = "SELECT publico_nome 
FROM publico_rsvp 
WHERE publico_id = '$part_id_evento_publico' 
ORDER BY publico_nome" ; 
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
   function lookup_enviar_app(&$enviar_app) 
   {
      $conteudo = "" ; 
      if ($enviar_app == "Y")
      { 
          $conteudo = "Sim";
      } 
      if ($enviar_app == "N")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $enviar_app = $conteudo; 
      } 
   }  
}
?>
