<?php
class chart_hospedagem_rsvp_lookup
{
//  
   function lookup_sc_free_group_by_hosp_id_evento(&$conteudo , $hosp_id_evento) 
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
      if (trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select evento_nome from eventos_rsvp where evento_id = $hosp_id_evento order by evento_nome" ; 
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
   function lookup_sc_free_group_by_hosp_id_hotel(&$conteudo , $hosp_id_hotel) 
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
   function lookup_sc_free_group_by_hosp_acomodacao(&$conteudo , $hosp_acomodacao) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $hosp_acomodacao; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($hosp_acomodacao) === "" || trim($hosp_acomodacao) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select acomodacao_desc from tbl_acomodacoes where acomodacao_id = $hosp_acomodacao order by acomodacao_desc" ; 
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
   function lookup_res_hosp_id_evento_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "hosp_id_evento";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup'];
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
               $this->lookup_hosp_id_evento_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'hosp_id_evento_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_hosp_id_evento_SC_1(&$conteudo , $hosp_id_evento) 
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
      if (trim($hosp_id_evento) === "" || trim($hosp_id_evento) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select evento_nome from eventos_rsvp where evento_id = '$hosp_id_evento' order by evento_nome" ; 
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
   function lookup_res_hosp_cpf_participante_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "hosp_cpf_participante";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup'];
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'hosp_cpf_participante_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_res_hosp_id_hotel_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "hosp_id_hotel";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup'];
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
               $this->lookup_hosp_id_hotel_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'hosp_id_hotel_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_hosp_id_hotel_SC_1(&$conteudo , $hosp_id_hotel) 
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
      $nm_comando = "select hotel_fantasia from tbl_hoteis where hotel_id = '$hosp_id_hotel' order by hotel_fantasia" ; 
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
   function lookup_res_hosp_acomodacao_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "hosp_acomodacao";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup'];
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
               $this->lookup_hosp_acomodacao_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'hosp_acomodacao_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_hosp_acomodacao_SC_1(&$conteudo , $hosp_acomodacao) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $hosp_acomodacao; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($hosp_acomodacao) === "" || trim($hosp_acomodacao) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select acomodacao_desc from tbl_acomodacoes where acomodacao_id = $hosp_acomodacao order by acomodacao_desc" ; 
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
   function lookup_res_hosp_categoria_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "hosp_categoria";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup'];
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
               $this->lookup_hosp_categoria_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'hosp_categoria_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_hosp_categoria_SC_1(&$conteudo , $hosp_categoria) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $hosp_categoria; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($hosp_categoria) === "" || trim($hosp_categoria) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select acomod_dsc from tbl_categ_acomod where acomod_id = $hosp_categoria order by acomod_dsc" ; 
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
   function lookup_res_hosp_status_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "hosp_status";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup'];
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
               $this->lookup_hosp_status_SC_1($val_format, $val_orig);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'hosp_status_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_hosp_status_SC_1(&$conteudo , $hosp_status) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $hosp_status; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select dsc_status from status_rsvp where status = '" . substr($this->Db->qstr($hosp_status), 1 , -1) . "' order by dsc_status" ; 
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
   function lookup_res_hosp_reserva_bvt_SC_1()
   {
       $result = array();
       $ind_count     = 1;
       $campos_select = "hosp_reserva_bvt";
       $nm_comando = "select " . $campos_select . ", COUNT(*) from " . $this->Ini->nm_tabela;
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup']))
       {
           $nm_comando .= " " .  $_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['where_res_lookup'];
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
               $this->lookup_hosp_reserva_bvt_SC_1($val_format);
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['chart_hospedagem_rsvp']['opcao'] == "ajax_res_fill_combo")
               {
                   $val_orig   = sc_convert_encoding($val_orig, "UTF-8", $_SESSION['scriptcase']['charset']);
                   $val_format = sc_convert_encoding($val_format, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               $result['set_option'][] = array('field' => 'hosp_reserva_bvt_SC_1', 'opt' => $val_orig, 'value' => $val_format);
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
   function lookup_hosp_reserva_bvt_SC_1(&$hosp_reserva_bvt_SC_1) 
   {
      $conteudo = "" ; 
      $hosp_reserva_bvt_SC_1_1 = explode(";", $hosp_reserva_bvt_SC_1) ;
      if (in_array("Y", $hosp_reserva_bvt_SC_1_1))
      { 
          $conteudo .= "SIM" . " ";
      } 
      if (in_array("N", $hosp_reserva_bvt_SC_1_1))
      { 
          $conteudo .= "NÃO" . " ";
      } 
      if (!empty($conteudo)) 
      { 
          $hosp_reserva_bvt_SC_1 = $conteudo; 
      } 
   }  
}
?>
