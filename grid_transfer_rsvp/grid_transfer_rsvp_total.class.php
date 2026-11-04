<?php

class grid_transfer_rsvp_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function __construct($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("pt_br");
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_transfer_rsvp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_transfer_rsvp']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tra_cpf_particip = (isset($Busca_temp['tra_cpf_particip'])) ? $Busca_temp['tra_cpf_particip'] : ""; 
          $tmp_pos = (is_string($this->tra_cpf_particip)) ? strpos($this->tra_cpf_particip, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_cpf_particip))
          {
              $this->tra_cpf_particip = substr($this->tra_cpf_particip, 0, $tmp_pos);
          }
          $this->tra_tipo_pessoa = (isset($Busca_temp['tra_tipo_pessoa'])) ? $Busca_temp['tra_tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tra_tipo_pessoa)) ? strpos($this->tra_tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_tipo_pessoa))
          {
              $this->tra_tipo_pessoa = substr($this->tra_tipo_pessoa, 0, $tmp_pos);
          }
          $this->tra_tipo = (isset($Busca_temp['tra_tipo'])) ? $Busca_temp['tra_tipo'] : ""; 
          $tmp_pos = (is_string($this->tra_tipo)) ? strpos($this->tra_tipo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_tipo))
          {
              $this->tra_tipo = substr($this->tra_tipo, 0, $tmp_pos);
          }
          $this->tra_status = (isset($Busca_temp['tra_status'])) ? $Busca_temp['tra_status'] : ""; 
          $tmp_pos = (is_string($this->tra_status)) ? strpos($this->tra_status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_status))
          {
              $this->tra_status = substr($this->tra_status, 0, $tmp_pos);
          }
          $this->tra_direcao = (isset($Busca_temp['tra_direcao'])) ? $Busca_temp['tra_direcao'] : ""; 
          $tmp_pos = (is_string($this->tra_direcao)) ? strpos($this->tra_direcao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_direcao))
          {
              $this->tra_direcao = substr($this->tra_direcao, 0, $tmp_pos);
          }
          $this->tra_numvoo_ida = (isset($Busca_temp['tra_numvoo_ida'])) ? $Busca_temp['tra_numvoo_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_numvoo_ida)) ? strpos($this->tra_numvoo_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_numvoo_ida))
          {
              $this->tra_numvoo_ida = substr($this->tra_numvoo_ida, 0, $tmp_pos);
          }
          $this->tra_dt_saida_ida = (isset($Busca_temp['tra_dt_saida_ida'])) ? $Busca_temp['tra_dt_saida_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_saida_ida)) ? strpos($this->tra_dt_saida_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_saida_ida))
          {
              $this->tra_dt_saida_ida = substr($this->tra_dt_saida_ida, 0, $tmp_pos);
          }
          $tra_dt_saida_ida_2 = (isset($Busca_temp['tra_dt_saida_ida_input_2'])) ? $Busca_temp['tra_dt_saida_ida_input_2'] : ""; 
          $this->tra_dt_saida_ida_2 = $tra_dt_saida_ida_2; 
          $this->tra_dt_chegada_ida = (isset($Busca_temp['tra_dt_chegada_ida'])) ? $Busca_temp['tra_dt_chegada_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_chegada_ida)) ? strpos($this->tra_dt_chegada_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_chegada_ida))
          {
              $this->tra_dt_chegada_ida = substr($this->tra_dt_chegada_ida, 0, $tmp_pos);
          }
          $tra_dt_chegada_ida_2 = (isset($Busca_temp['tra_dt_chegada_ida_input_2'])) ? $Busca_temp['tra_dt_chegada_ida_input_2'] : ""; 
          $this->tra_dt_chegada_ida_2 = $tra_dt_chegada_ida_2; 
          $this->tra_localizador_ida = (isset($Busca_temp['tra_localizador_ida'])) ? $Busca_temp['tra_localizador_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_localizador_ida)) ? strpos($this->tra_localizador_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_localizador_ida))
          {
              $this->tra_localizador_ida = substr($this->tra_localizador_ida, 0, $tmp_pos);
          }
          $this->tra_eticket_ida = (isset($Busca_temp['tra_eticket_ida'])) ? $Busca_temp['tra_eticket_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_eticket_ida)) ? strpos($this->tra_eticket_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_eticket_ida))
          {
              $this->tra_eticket_ida = substr($this->tra_eticket_ida, 0, $tmp_pos);
          }
          $this->tra_numvoo_volta = (isset($Busca_temp['tra_numvoo_volta'])) ? $Busca_temp['tra_numvoo_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_numvoo_volta)) ? strpos($this->tra_numvoo_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_numvoo_volta))
          {
              $this->tra_numvoo_volta = substr($this->tra_numvoo_volta, 0, $tmp_pos);
          }
          $this->tra_dt_saida_volta = (isset($Busca_temp['tra_dt_saida_volta'])) ? $Busca_temp['tra_dt_saida_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_saida_volta)) ? strpos($this->tra_dt_saida_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_saida_volta))
          {
              $this->tra_dt_saida_volta = substr($this->tra_dt_saida_volta, 0, $tmp_pos);
          }
          $tra_dt_saida_volta_2 = (isset($Busca_temp['tra_dt_saida_volta_input_2'])) ? $Busca_temp['tra_dt_saida_volta_input_2'] : ""; 
          $this->tra_dt_saida_volta_2 = $tra_dt_saida_volta_2; 
          $this->tra_dt_chegada_volta = (isset($Busca_temp['tra_dt_chegada_volta'])) ? $Busca_temp['tra_dt_chegada_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_chegada_volta)) ? strpos($this->tra_dt_chegada_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_chegada_volta))
          {
              $this->tra_dt_chegada_volta = substr($this->tra_dt_chegada_volta, 0, $tmp_pos);
          }
          $tra_dt_chegada_volta_2 = (isset($Busca_temp['tra_dt_chegada_volta_input_2'])) ? $Busca_temp['tra_dt_chegada_volta_input_2'] : ""; 
          $this->tra_dt_chegada_volta_2 = $tra_dt_chegada_volta_2; 
          $this->tra_localizador_volta = (isset($Busca_temp['tra_localizador_volta'])) ? $Busca_temp['tra_localizador_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_localizador_volta)) ? strpos($this->tra_localizador_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_localizador_volta))
          {
              $this->tra_localizador_volta = substr($this->tra_localizador_volta, 0, $tmp_pos);
          }
          $this->tra_eticket_volta = (isset($Busca_temp['tra_eticket_volta'])) ? $Busca_temp['tra_eticket_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_eticket_volta)) ? strpos($this->tra_eticket_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_eticket_volta))
          {
              $this->tra_eticket_volta = substr($this->tra_eticket_volta, 0, $tmp_pos);
          }
          $this->tra_dt_chegada_proprio = (isset($Busca_temp['tra_dt_chegada_proprio'])) ? $Busca_temp['tra_dt_chegada_proprio'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_chegada_proprio)) ? strpos($this->tra_dt_chegada_proprio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_chegada_proprio))
          {
              $this->tra_dt_chegada_proprio = substr($this->tra_dt_chegada_proprio, 0, $tmp_pos);
          }
          $tra_dt_chegada_proprio_2 = (isset($Busca_temp['tra_dt_chegada_proprio_input_2'])) ? $Busca_temp['tra_dt_chegada_proprio_input_2'] : ""; 
          $this->tra_dt_chegada_proprio_2 = $tra_dt_chegada_proprio_2; 
          $this->tra_hr_chegada_proprio = (isset($Busca_temp['tra_hr_chegada_proprio'])) ? $Busca_temp['tra_hr_chegada_proprio'] : ""; 
          $tmp_pos = (is_string($this->tra_hr_chegada_proprio)) ? strpos($this->tra_hr_chegada_proprio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_hr_chegada_proprio))
          {
              $this->tra_hr_chegada_proprio = substr($this->tra_hr_chegada_proprio, 0, $tmp_pos);
          }
          $this->tra_hr_volta_local = (isset($Busca_temp['tra_hr_volta_local'])) ? $Busca_temp['tra_hr_volta_local'] : ""; 
          $tmp_pos = (is_string($this->tra_hr_volta_local)) ? strpos($this->tra_hr_volta_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_hr_volta_local))
          {
              $this->tra_hr_volta_local = substr($this->tra_hr_volta_local, 0, $tmp_pos);
          }
          $this->tra_dt_volta_local = (isset($Busca_temp['tra_dt_volta_local'])) ? $Busca_temp['tra_dt_volta_local'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_volta_local)) ? strpos($this->tra_dt_volta_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_volta_local))
          {
              $this->tra_dt_volta_local = substr($this->tra_dt_volta_local, 0, $tmp_pos);
          }
          $tra_dt_volta_local_2 = (isset($Busca_temp['tra_dt_volta_local_input_2'])) ? $Busca_temp['tra_dt_volta_local_input_2'] : ""; 
          $this->tra_dt_volta_local_2 = $tra_dt_volta_local_2; 
          $this->tra_hr_ida_local = (isset($Busca_temp['tra_hr_ida_local'])) ? $Busca_temp['tra_hr_ida_local'] : ""; 
          $tmp_pos = (is_string($this->tra_hr_ida_local)) ? strpos($this->tra_hr_ida_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_hr_ida_local))
          {
              $this->tra_hr_ida_local = substr($this->tra_hr_ida_local, 0, $tmp_pos);
          }
          $this->tra_dt_ida_local = (isset($Busca_temp['tra_dt_ida_local'])) ? $Busca_temp['tra_dt_ida_local'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_ida_local)) ? strpos($this->tra_dt_ida_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_ida_local))
          {
              $this->tra_dt_ida_local = substr($this->tra_dt_ida_local, 0, $tmp_pos);
          }
          $tra_dt_ida_local_2 = (isset($Busca_temp['tra_dt_ida_local_input_2'])) ? $Busca_temp['tra_dt_ida_local_input_2'] : ""; 
          $this->tra_dt_ida_local_2 = $tra_dt_ida_local_2; 
          $this->id_transfer = (isset($Busca_temp['id_transfer'])) ? $Busca_temp['id_transfer'] : ""; 
          $tmp_pos = (is_string($this->id_transfer)) ? strpos($this->id_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id_transfer))
          {
              $this->id_transfer = substr($this->id_transfer, 0, $tmp_pos);
          }
          $this->tra_id_bloqueio = (isset($Busca_temp['tra_id_bloqueio'])) ? $Busca_temp['tra_id_bloqueio'] : ""; 
          $tmp_pos = (is_string($this->tra_id_bloqueio)) ? strpos($this->tra_id_bloqueio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_id_bloqueio))
          {
              $this->tra_id_bloqueio = substr($this->tra_id_bloqueio, 0, $tmp_pos);
          }
          $this->tra_id_evento = (isset($Busca_temp['tra_id_evento'])) ? $Busca_temp['tra_id_evento'] : ""; 
          $tmp_pos = (is_string($this->tra_id_evento)) ? strpos($this->tra_id_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_id_evento))
          {
              $this->tra_id_evento = substr($this->tra_id_evento, 0, $tmp_pos);
          }
          $this->tra_id_aereo = (isset($Busca_temp['tra_id_aereo'])) ? $Busca_temp['tra_id_aereo'] : ""; 
          $tmp_pos = (is_string($this->tra_id_aereo)) ? strpos($this->tra_id_aereo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_id_aereo))
          {
              $this->tra_id_aereo = substr($this->tra_id_aereo, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $tra_id_evento, $tra_id_usuario, $tra_id_hotel, $tra_id_bloqueio;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['contr_total_geral'] = "OK";
   } 

   function Ajust_statistic($comando)
   {
      if ((isset($this->Ini->nm_bases_vfp) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) || (isset($this->Ini->nm_bases_odbc) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc)))
      {
          $comando = str_replace(array('count(distinct ','varp(','stdevp(','variance(','stddev('), array('sum(','sum(','sum(','sum(','sum('), $comando);
      }
      if ($this->Ini->nm_tp_variance == "P")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $comando = str_replace(array('count(distinct ','varp(','stdevp('), array('count(','var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $this->Ini->Ibase_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
                  $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
      }
      if ($this->Ini->nm_tp_variance == "A")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $comando = str_replace(array('count(distinct ','varp(','stdevp('), array('count(','var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $this->Ini->Ibase_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
                  $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $comando = str_replace(array('varp(','stdevp('), array('var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $comando = str_replace('stddev(', 'stdev(', $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $comando = str_replace(array('variance(','stddev('), array('variance_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
      }
      return $comando;
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 

function GetPresAtiva($pcampo_1,$pcampo_2,$pcampo_3,$ptabela,$pcpf,$pevt,$porder) {
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
  		$ret = 'ERRO';
		$sql = "
 			SELECT 
				$pcampo_1, $pcampo_2, $pcampo_3
			FROM 
				$ptabela
			WHERE 
				$pcampo_1 = ".$this->Db->qstr($pcpf)." 
			AND 
				$pcampo_2 = ".$this->Db->qstr($pevt)."
			ORDER BY 
				$porder 
		";	
		 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
    
		if (isset($this->rs[0][0])) {
			$ret = $this->rs[0][2];
		}
		return $ret;
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  	
	date_default_timezone_set('America/Sao_Paulo');
	$sql = "
  	SELECT 
		usuario_id,
		usuario_nivel,
		usuario_email,		
		usuario_nome,
		usuario_cpf
	FROM	
		usuarios_rsvp 
	WHERE
		usuario_id = ".$this->Db->qstr($idu)." 
	ORDER BY
		usuario_id"
	;
	 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs[0][0])) {			
		switch($tipo) {
			case 'nivel':
				$ret = $this->rs[0][1];
				break;
			case 'nome':
				$ret = $this->rs[0][3];
				break;
			case 'cpf':
				$ret = $this->rs[0][4];
				break;
		}	 
	
	} else {
		$ret = 'ERRO';
	}	
	return $ret;
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		switch($nivel) {
		case 'ADMINISTRADOR':
			break;
		case 'CONVIDADO':
			$this->nmgp_botoes["delete"] = 'off';;	
			break;		
		case 'EXECUTIVO':
			$this->nmgp_botoes["delete"] = 'off';;	
			break;				
		case 'OPERACIONAL':
			$this->nmgp_botoes["delete"] = 'off';;	
			break;				
		case 'SUPERVISOR':
			$this->nmgp_botoes["delete"] = 'on';;	
			break;						
	}
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  
	date_default_timezone_set('America/Sao_Paulo');
	$sqlusok = "
		SELECT
			usuario_id,
			usuario_cpf
		FROM
			usuarios_rsvp
		WHERE
			usuario_id = ".$this->Db->qstr($pusuario)."		
		ORDER BY
			usuario_id		
	";
	 
      $nm_select = $sqlusok; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs[0][0]))
		$ret = $this->rs[0][0];
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}

}

?>
