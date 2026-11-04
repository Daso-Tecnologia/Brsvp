<?php
class grid_acompanhantes_rsvp_rec_lookup
{
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
}
?>
