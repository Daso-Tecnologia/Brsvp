<?php
class grid_usuarios_rsvp_2fa_lookup
{
//  
   function lookup_usuario_status(&$usuario_status) 
   {
      $conteudo = "" ; 
      if ($usuario_status == "A")
      { 
          $conteudo = "ATIVO";
      } 
      if ($usuario_status == "I")
      { 
          $conteudo = "INATIVO";
      } 
      if (!empty($conteudo)) 
      { 
          $usuario_status = $conteudo; 
      } 
   }  
//  
   function lookup_com_googlecode(&$com_googlecode) 
   {
      $conteudo = "" ; 
      if ($com_googlecode == "Y")
      { 
          $conteudo = "SIM";
      } 
      if ($com_googlecode == "N")
      { 
          $conteudo = "NÃO";
      } 
      if (!empty($conteudo)) 
      { 
          $com_googlecode = $conteudo; 
      } 
   }  
//  
   function lookup_usuario_colaborador(&$usuario_colaborador) 
   {
      $conteudo = "" ; 
      if ($usuario_colaborador == "Y")
      { 
          $conteudo = "SIM";
      } 
      if ($usuario_colaborador == "N")
      { 
          $conteudo = "NÃO";
      } 
      if (!empty($conteudo)) 
      { 
          $usuario_colaborador = $conteudo; 
      } 
   }  
}
?>
