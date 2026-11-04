<?php

class grid_participantes_rsvp_1_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_participantes_rsvp_1']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_participantes_rsvp_1']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->part_ativo = (isset($Busca_temp['part_ativo'])) ? $Busca_temp['part_ativo'] : ""; 
          $tmp_pos = (is_string($this->part_ativo)) ? strpos($this->part_ativo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ativo))
          {
              $this->part_ativo = substr($this->part_ativo, 0, $tmp_pos);
          }
          $this->part_cpf = (isset($Busca_temp['part_cpf'])) ? $Busca_temp['part_cpf'] : ""; 
          $tmp_pos = (is_string($this->part_cpf)) ? strpos($this->part_cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cpf))
          {
              $this->part_cpf = substr($this->part_cpf, 0, $tmp_pos);
          }
          $this->nome_pessoa = (isset($Busca_temp['nome_pessoa'])) ? $Busca_temp['nome_pessoa'] : ""; 
          $tmp_pos = (is_string($this->nome_pessoa)) ? strpos($this->nome_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nome_pessoa))
          {
              $this->nome_pessoa = substr($this->nome_pessoa, 0, $tmp_pos);
          }
          $this->part_sexo = (isset($Busca_temp['part_sexo'])) ? $Busca_temp['part_sexo'] : ""; 
          $tmp_pos = (is_string($this->part_sexo)) ? strpos($this->part_sexo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_sexo))
          {
              $this->part_sexo = substr($this->part_sexo, 0, $tmp_pos);
          }
          $this->part_acompanhado = (isset($Busca_temp['part_acompanhado'])) ? $Busca_temp['part_acompanhado'] : ""; 
          $tmp_pos = (is_string($this->part_acompanhado)) ? strpos($this->part_acompanhado, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_acompanhado))
          {
              $this->part_acompanhado = substr($this->part_acompanhado, 0, $tmp_pos);
          }
          $this->part_id_evento_publico = (isset($Busca_temp['part_id_evento_publico'])) ? $Busca_temp['part_id_evento_publico'] : ""; 
          $tmp_pos = (is_string($this->part_id_evento_publico)) ? strpos($this->part_id_evento_publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_id_evento_publico))
          {
              $this->part_id_evento_publico = substr($this->part_id_evento_publico, 0, $tmp_pos);
          }
          $this->part_id_evento_regional = (isset($Busca_temp['part_id_evento_regional'])) ? $Busca_temp['part_id_evento_regional'] : ""; 
          $tmp_pos = (is_string($this->part_id_evento_regional)) ? strpos($this->part_id_evento_regional, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_id_evento_regional))
          {
              $this->part_id_evento_regional = substr($this->part_id_evento_regional, 0, $tmp_pos);
          }
          $this->part_contato_rsvp = (isset($Busca_temp['part_contato_rsvp'])) ? $Busca_temp['part_contato_rsvp'] : ""; 
          $tmp_pos = (is_string($this->part_contato_rsvp)) ? strpos($this->part_contato_rsvp, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_contato_rsvp))
          {
              $this->part_contato_rsvp = substr($this->part_contato_rsvp, 0, $tmp_pos);
          }
          $this->part_presenca = (isset($Busca_temp['part_presenca'])) ? $Busca_temp['part_presenca'] : ""; 
          $tmp_pos = (is_string($this->part_presenca)) ? strpos($this->part_presenca, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_presenca))
          {
              $this->part_presenca = substr($this->part_presenca, 0, $tmp_pos);
          }
          $this->part_aereo_ok = (isset($Busca_temp['part_aereo_ok'])) ? $Busca_temp['part_aereo_ok'] : ""; 
          $tmp_pos = (is_string($this->part_aereo_ok)) ? strpos($this->part_aereo_ok, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_aereo_ok))
          {
              $this->part_aereo_ok = substr($this->part_aereo_ok, 0, $tmp_pos);
          }
          $this->part_hotel = (isset($Busca_temp['part_hotel'])) ? $Busca_temp['part_hotel'] : ""; 
          $tmp_pos = (is_string($this->part_hotel)) ? strpos($this->part_hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_hotel))
          {
              $this->part_hotel = substr($this->part_hotel, 0, $tmp_pos);
          }
          $this->part_transfer = (isset($Busca_temp['part_transfer'])) ? $Busca_temp['part_transfer'] : ""; 
          $tmp_pos = (is_string($this->part_transfer)) ? strpos($this->part_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_transfer))
          {
              $this->part_transfer = substr($this->part_transfer, 0, $tmp_pos);
          }
          $this->part_hospedagem = (isset($Busca_temp['part_hospedagem'])) ? $Busca_temp['part_hospedagem'] : ""; 
          $tmp_pos = (is_string($this->part_hospedagem)) ? strpos($this->part_hospedagem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_hospedagem))
          {
              $this->part_hospedagem = substr($this->part_hospedagem, 0, $tmp_pos);
          }
          $this->part_programacao = (isset($Busca_temp['part_programacao'])) ? $Busca_temp['part_programacao'] : ""; 
          $tmp_pos = (is_string($this->part_programacao)) ? strpos($this->part_programacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_programacao))
          {
              $this->part_programacao = substr($this->part_programacao, 0, $tmp_pos);
          }
          $this->part_solicit_especial = (isset($Busca_temp['part_solicit_especial'])) ? $Busca_temp['part_solicit_especial'] : ""; 
          $tmp_pos = (is_string($this->part_solicit_especial)) ? strpos($this->part_solicit_especial, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_solicit_especial))
          {
              $this->part_solicit_especial = substr($this->part_solicit_especial, 0, $tmp_pos);
          }
          $this->part_confirm_viagem = (isset($Busca_temp['part_confirm_viagem'])) ? $Busca_temp['part_confirm_viagem'] : ""; 
          $tmp_pos = (is_string($this->part_confirm_viagem)) ? strpos($this->part_confirm_viagem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_confirm_viagem))
          {
              $this->part_confirm_viagem = substr($this->part_confirm_viagem, 0, $tmp_pos);
          }
          $this->part_opcionais = (isset($Busca_temp['part_opcionais'])) ? $Busca_temp['part_opcionais'] : ""; 
          $tmp_pos = (is_string($this->part_opcionais)) ? strpos($this->part_opcionais, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_opcionais))
          {
              $this->part_opcionais = substr($this->part_opcionais, 0, $tmp_pos);
          }
          $this->part_substituido = (isset($Busca_temp['part_substituido'])) ? $Busca_temp['part_substituido'] : ""; 
          $tmp_pos = (is_string($this->part_substituido)) ? strpos($this->part_substituido, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_substituido))
          {
              $this->part_substituido = substr($this->part_substituido, 0, $tmp_pos);
          }
          $this->part_substituto = (isset($Busca_temp['part_substituto'])) ? $Busca_temp['part_substituto'] : ""; 
          $tmp_pos = (is_string($this->part_substituto)) ? strpos($this->part_substituto, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_substituto))
          {
              $this->part_substituto = substr($this->part_substituto, 0, $tmp_pos);
          }
          $this->part_grupo = (isset($Busca_temp['part_grupo'])) ? $Busca_temp['part_grupo'] : ""; 
          $tmp_pos = (is_string($this->part_grupo)) ? strpos($this->part_grupo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_grupo))
          {
              $this->part_grupo = substr($this->part_grupo, 0, $tmp_pos);
          }
          $this->part_clube = (isset($Busca_temp['part_clube'])) ? $Busca_temp['part_clube'] : ""; 
          $tmp_pos = (is_string($this->part_clube)) ? strpos($this->part_clube, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_clube))
          {
              $this->part_clube = substr($this->part_clube, 0, $tmp_pos);
          }
          $this->part_empresa = (isset($Busca_temp['part_empresa'])) ? $Busca_temp['part_empresa'] : ""; 
          $tmp_pos = (is_string($this->part_empresa)) ? strpos($this->part_empresa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_empresa))
          {
              $this->part_empresa = substr($this->part_empresa, 0, $tmp_pos);
          }
          $this->part_departamento = (isset($Busca_temp['part_departamento'])) ? $Busca_temp['part_departamento'] : ""; 
          $tmp_pos = (is_string($this->part_departamento)) ? strpos($this->part_departamento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_departamento))
          {
              $this->part_departamento = substr($this->part_departamento, 0, $tmp_pos);
          }
          $this->part_cargo = (isset($Busca_temp['part_cargo'])) ? $Busca_temp['part_cargo'] : ""; 
          $tmp_pos = (is_string($this->part_cargo)) ? strpos($this->part_cargo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cargo))
          {
              $this->part_cargo = substr($this->part_cargo, 0, $tmp_pos);
          }
          $this->part_cidade = (isset($Busca_temp['part_cidade'])) ? $Busca_temp['part_cidade'] : ""; 
          $tmp_pos = (is_string($this->part_cidade)) ? strpos($this->part_cidade, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cidade))
          {
              $this->part_cidade = substr($this->part_cidade, 0, $tmp_pos);
          }
          $this->part_uf = (isset($Busca_temp['part_uf'])) ? $Busca_temp['part_uf'] : ""; 
          $tmp_pos = (is_string($this->part_uf)) ? strpos($this->part_uf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_uf))
          {
              $this->part_uf = substr($this->part_uf, 0, $tmp_pos);
          }
          $this->part_email = (isset($Busca_temp['part_email'])) ? $Busca_temp['part_email'] : ""; 
          $tmp_pos = (is_string($this->part_email)) ? strpos($this->part_email, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_email))
          {
              $this->part_email = substr($this->part_email, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $part_id_evento_publico, $part_cpf;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(participante_id) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(participante_id) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(participante_id) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['tot_geral'][2] = $rt->fields[1]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['contr_total_geral'] = "OK";
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

function additens_menuhorizontal () {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  

	?>

	<link rel="stylesheet" type="text/css" href="<?php echo sc_url_library('sys', 'bootstrap', 'bootstrap.min.css'); ?>" />
	<script type="text/javascript" src="<?php echo sc_url_library('sys', 'bootstrap', 'bootstrap.min.js'); ?>">
	<script type="text/javascript" src="<?php echo sc_url_library('sys', 'bootstrap', 'jquery.min.js'); ?>">
		
	<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Cadastrar </a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logar </a></li>
    </ul>

	<?php
	

$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function CheckLog($chave) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$ret = 'ok';
		$tipo = strlen($chave);
		if ($tipo >= 11) {
			$sql = "
				SELECT
					cod_usuario
				FROM
					rsvpses_log
				WHERE
					cod_usuario = ".$this->Db->qstr($chave)."
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
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		} else {	
			$sql = "
				SELECT
					id_usuario
				FROM
					rsvpses_log
				WHERE
					id_usuario = ".$this->Db->qstr($chave)."
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
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		}	
		return $ret;
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GetSaldoBloq($evento_id, $direcao) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		$ret = TRUE;
		$valor_y = 'Y';
		$valor_n = 'N';
		$valor_0 = '0';
	
		$sqlx="
		SELECT 
			aereo_id_evento,aereo_bloqueio_id 
		FROM 
			aereos_rsvp
		WHERE 
			aereo_id_evento = ".$this->Db->qstr($evento_id)."	
		AND 
			aereo_bloqueio_id <> ".$this->Db->qstr($valor_0)."
		AND 
			aereo_status <>  ".$this->Db->qstr($valor_n)."
		AND 
			aereo_direcao =  ".$this->Db->qstr($direcao)."
		AND
			aereo_ativo  = ".$this->Db->qstr($valor_y)."		
		ORDER BY 
			aereo_cpf_particip, aereo_id_evento"
		;	
		 
      $nm_select = $sqlx; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsl = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsl[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsl = false;
          $this->rsl_erro = $this->Db->ErrorMsg();
      } 
	
		if (isset($this->rsl[0][0])) {	
				$bloqueio = $this->rsl[0][1];
				$sqljoin="
				SELECT 
					aereos_rsvp.aereo_bloqueio_id,aereos_rsvp.aereo_id_evento,bloqueio_aereo_rsvp.bloq_qtd_lugares,COUNT(aereos_rsvp.aereo_bloqueio_id) AS qtd_aereo, 
					aereos_rsvp.aereo_direcao,aereos_rsvp.aereo_status
				FROM
					aereos_rsvp
				INNER JOIN 
					bloqueio_aereo_rsvp
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id
				WHERE
					aereos_rsvp.aereo_bloqueio_id =  ".$this->Db->qstr($bloqueio)."
				AND 
					aereos_rsvp.aereo_status <> ".$this->Db->qstr($valor_n)." AND aereos_rsvp.aereo_direcao = ".$this->Db->qstr($direcao)."
				GROUP BY 
					aereos_rsvp.aereo_bloqueio_id"
				;	
				 
      $nm_select = $sqljoin; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsjoin = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsjoin[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsjoin = false;
          $this->rsjoin_erro = $this->Db->ErrorMsg();
      } 
		
				if (isset($this->rsjoin[0][0])) {
					$bloqueio_id	= $this->rsjoin[0][0];
					$qtd_lugares	= $this->rsjoin[0][2];
					$qtd_bloqueio	= $this->rsjoin[0][3];
					$saldo			= $qtd_lugares - $qtd_bloqueio;
					$sqlupd="	
					UPDATE 
						bloqueio_aereo_rsvp
					SET 
						bloq_saldo_lugares = ".$this->Db->qstr($saldo)."
					WHERE 
						bloqueio_id = ".$this->Db->qstr($bloqueio_id)." 
					";
					 
      $nm_select = $sqlupd; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsupd = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsupd[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsupd = false;
          $this->rsupd_erro = $this->Db->ErrorMsg();
      } 
	
					$ret = $saldo;
				} else {
					$ret = FALSE;	
				}	
		} else {
			$sqls="
			SELECT 
				bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
			FROM
				bloqueio_aereo_rsvp
			WHERE
				bloq_evento_id = ".$this->Db->qstr($evento_id)."	
			AND
				bloq_direcao = ".$this->Db->qstr($direcao)."
			ORDER BY
				bloq_evento_id,bloq_direcao
			";
			 
      $nm_select = $sqls; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rss = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rss[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rss = false;
          $this->rss_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($this->rss[0][0])) {	
				$bloq_id = $this->rss[0][0];	
				$qtd_lugares = $this->rss[0][3];			
				$sqlupd="	
				UPDATE 
					bloqueio_aereo_rsvp
				SET 
					bloq_saldo_lugares = ".$this->Db->qstr($qtd_lugares)." 
				WHERE 
					bloqueio_id =  ".$this->Db->qstr($bloq_id)."  		
				";
				
     $nm_select = $sqlupd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
			}	
		}	
		return $ret;
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function getTokenApp(){
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  	
	date_default_timezone_set('America/Sao_Paulo');
	$curl = curl_init();
	
	
	curl_setopt_array($curl, array(
  	CURLOPT_URL => 'https://api.beinvited.com.br/oauth-token',
	CURLOPT_RETURNTRANSFER => true,
  	CURLOPT_ENCODING => '',
  	CURLOPT_MAXREDIRS => 10,
  	CURLOPT_TIMEOUT => 0,
  	CURLOPT_FOLLOWLOCATION => true,
  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  	CURLOPT_CUSTOMREQUEST => 'POST',
  	CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=SEU_CLIENT_ID&client_secret=SEU_CLIENT_SECRET',
  	CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  	),
	));
	
	$resp = curl_exec($curl);
	curl_close($curl);	
	$response = json_decode($resp, true);
	$token = $response['access_token'];
	$tokenType = $response['token_type'];
	$expiresIn = $response['expires_in'];
	$scope = $response['scope'];
	
	return $token;

$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GetUsuarioNivel2($idu,$tipo) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
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
			usuario_cpf = ".$this->Db->qstr($idu)." 
		ORDER BY
			usuario_cpf"
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$ret = false;
		$sqli = "					
		INSERT INTO
			rsvp_log
			(data_hora,
			ip,
			id_usuario,
			cod_usuario,
			modulo,
			aplicacao,
			acao,
			campo_id,	
			valor_campo_id,	
			campo_cpf,     	
			valor_campo_cpf,	
			campo_evt,
			valor_campo_evt,
			tabela,
			obs,
			csql)							
		VALUES
			(".$this->Db->qstr($v_hora_now).", 				 
			".$this->Db->qstr($v_ip_usuario).",               
			".$this->Db->qstr($v_id_usuario).",         	
			".$this->Db->qstr($v_global_cpf).",              
			".$this->Db->qstr($v_modulo).",     	
			".$this->Db->qstr($v_aplicacao).",  	                     
			".$this->Db->qstr($v_acao).",    
			".$this->Db->qstr($v_campo_id).",         	
			".$this->Db->qstr($v_vl_campo_id).",	             
			".$this->Db->qstr($v_campo_cpf).",                   	
			".$this->Db->qstr($v_vl_campo_cpf).",               	
			".$this->Db->qstr($v_campo_evt).",               
			".$this->Db->qstr($v_vl_campo_evt).",						
			".$this->Db->qstr($v_tabela).",
			".$this->Db->qstr($v_obs).",
			".$this->Db->qstr($v_sql).")									
		";		
		
     $nm_select = $sqli; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
		
		$ret = true;
		return $ret;
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function MakeColor($vp_evento,$vp_cpf,$tipo) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');

	
		$valor_y = 'Y';
		$valor_a = 'A';
		$valor_n = 'N';
		
		if ($tipo == 'I') {
			$sqlmestre = "
				SELECT
					part_id_evento,
					part_cpf,
					part_contato_rsvp,
					part_presenca,
					part_solicit_especial,
					part_programacao,
					part_aereo,
					part_hospedagem,
					part_transfer,
					part_opcionais
				FROM
					participantes_rsvp
				WHERE   
					part_id_evento = ".$this->Db->qstr($vp_evento)."
				AND 
					part_cpf = ".$this->Db->qstr($vp_cpf)."
				ORDER BY 
					part_id_evento,part_cpf
			";		
		} else {
			$sqlmestre = "
				SELECT
					part_id_evento,
					part_cpf,
					part_contato_rsvp,
					part_presenca,
					part_solicit_especial,
					part_programacao,
					part_aereo,
					part_hospedagem,
					part_transfer,
					part_opcionais
				FROM
					participantes_rsvp
				WHERE   
					part_id_evento = ".$this->Db->qstr($vp_evento)."
				ORDER BY 
					part_id_evento,part_cpf
			";		
		}			
		 
      $nm_select = $sqlmestre; 
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
	
		$reg_inc = sizeof($this->rs );
		if ($reg_inc > 0) {
			for ($i=0;$i<$reg_inc;++$i) {	
				$evento_id			= $this->rs[$i][0];   
				$cpf_mestre			= $this->rs[$i][1];   
				$contato_mestre		= $this->rs[$i][2];  
				$presenca_mestre	= $this->rs[$i][3];  
				$solicitacao		= $this->rs[$i][4];  
				$programacao		= $this->rs[$i][5];  
				$aereo				= $this->rs[$i][6];  
				$hospedagem			= $this->rs[$i][7];  
				$transfer			= $this->rs[$i][8];  
				$opcionais			= $this->rs[$i][9];			

				$sqlcon = "
					SELECT
						contato_status
					FROM	
						contatos_rsvp	
					WHERE
						contato_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						contato_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						contato_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlcon; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscon = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscon[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscon = false;
          $this->rscon_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rscon[0][0])) {
					$_atu_contato = $this->rscon[0][0];			
					$sqlucon = "
						UPDATE 
							participantes_rsvp
						SET 
							part_contato_rsvp = ".$this->Db->qstr($_atu_contato)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlucon; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqlucon = "
						UPDATE 
							participantes_rsvp
						SET 
							part_contato_rsvp = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";
					
     $nm_select = $sqlucon; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}	

				$sqlpres = "
					SELECT
						presenca_status
					FROM
						presencas_rsvp	
					WHERE
						presenca_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						presenca_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						presenca_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlpres; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspres = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspres[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspres = false;
          $this->rspres_erro = $this->Db->ErrorMsg();
      } 
			
				if (isset($this->rspres[0][0])) {
					$_atu_pres = $this->rspres[0][0];
					$sqlupres = "
						UPDATE 
							participantes_rsvp
						SET 
							part_presenca = ".$this->Db->qstr($_atu_pres)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";
					
     $nm_select = $sqlupres; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqlupres = "
						UPDATE 
							participantes_rsvp
						SET 
							part_presenca = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";			
					
     $nm_select = $sqlupres; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}			

				$sqlsol = "
					SELECT
						solicitacao_status
					FROM
						solicitacoes_rsvp	
					WHERE
						solicitacao_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						solicitacao_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						solicitacao_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlsol; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssol = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rssol[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssol = false;
          $this->rssol_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rssol[0][0])) {
					$_atu_sol = $this->rssol[0][0];
					$sqlusol = "
						UPDATE 
							participantes_rsvp
						SET 
							part_solicit_especial = ".$this->Db->qstr($_atu_sol)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlusol; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqlusol = "
						UPDATE 
							participantes_rsvp
						SET 
							part_solicit_especial = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";			
					
     $nm_select = $sqlusol; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}		

				$sqlpro = "
					SELECT
						programac_ativo
					FROM
						programac_rsvp
					WHERE
						programac_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						programac_id_evento = ".$this->Db->qstr($evento_id)."
					AND 
						programac_ativo = ".$this->Db->qstr($valor_y)."
					ORDER BY
						programac_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlpro; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspro = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspro[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspro = false;
          $this->rspro_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rspro[0][0])) {
					$_atu_pro = $this->rspro[0][0];
					$sqlupro = "
					UPDATE 
						participantes_rsvp
					SET 
						part_programacao = ".$this->Db->qstr($_atu_pro)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlupro; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqlupro = "
					UPDATE 
						participantes_rsvp
					SET 
						part_programacao = ".$this->Db->qstr($valor_n)." 
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlupro; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}	

				$contverde = '0';  		  
				$contaberto = '0'; 
				$contamarelo = '0'; 
				$controxo = '0'; 
				$contvermelho = '0';		
				$contot = 0;
				$vpart_aereo = 'A';
				$sqlaer = "
				SELECT
						aereo_status,
						aereo_direcao,
						aereo_cpf_particip
					FROM
						aereos_rsvp
					WHERE
						aereo_id_evento = ".$this->Db->qstr($evento_id)."
					AND	
						aereo_cpf_particip = ".$this->Db->qstr($cpf_mestre)."
					AND	
						aereo_ativo = ".$this->Db->qstr($valor_y)." 
					ORDER BY
						aereo_id_evento,aereo_cpf_particip,aereo_direcao
				";
				 
      $nm_select = $sqlaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaer = false;
          $this->rsaer_erro = $this->Db->ErrorMsg();
      } 
	
				$reg_aer = sizeof($this->rsaer );
				if ($reg_aer > 0) {
					for ($i2=0;$i2<$reg_aer;++$i2) {									
						$vaereo_status = $this->rsaer[$i2][0];				
						switch($vaereo_status) {
							case 'Y':
								$contverde = '1';  		  
								break;
							case 'A':
								$contaberto = '2'; 
								break;							
							case 'P':
								$contamarelo = '3'; 
								break;							
							case 'N':
								$contvermelho = '4'; 
								break;							
						}												
						$resultado = $contverde.$contaberto.$contamarelo.$contvermelho;		
						switch($resultado) {
							case '1000':
								if ($reg_aer == 1) {
									$vpart_aereo = 'R';
								} else {
									$vpart_aereo = 'Y';
								}	
								break;						
							case '0200':
								$vpart_aereo = 'A';
								break;						
							case '0030':
								$vpart_aereo = 'P';
								break;
							case '0004':
								$vpart_aereo = 'N';
								break;
							default:	
								$vpart_aereo = 'R';
								break;							
						}												
					}					
					$sqluaer = "
						UPDATE 
							participantes_rsvp
						SET 
							part_aereo = ".$this->Db->qstr($vpart_aereo).",
							part_aereo_ok = ".$this->Db->qstr($vpart_aereo)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqluaer; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqluaer = "
					UPDATE 
						participantes_rsvp
					SET 
						part_aereo = ".$this->Db->qstr($valor_a).",
						part_aereo_ok = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqluaer; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}

				$sqlhos = "
					SELECT
						hosp_id_evento,
						hosp_cpf_participante,
						hosp_id_hotel,
						hosp_status
					FROM
						hospedagem_rsvp
					WHERE
						hosp_id_evento = ".$this->Db->qstr($evento_id)."
					AND	
						hosp_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						hosp_ativo = ".$this->Db->qstr($valor_y)."
					ORDER BY
						hosp_dt_checkin DESC, hosp_hr_checkin DESC, hosp_id_hotel
					LIMIT 1						
				";
				 
      $nm_select = $sqlhos; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshos = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshos[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshos = false;
          $this->rshos_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rshos[0][0])) {
					$status_hos = $this->rshos[0][3];
					$sqluhos = "
					UPDATE 
						participantes_rsvp
					SET 
						part_hospedagem = ".$this->Db->qstr($status_hos).",
						part_hotel = ".$this->Db->qstr($status_hos)."						
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluhos; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqluhos = "
					UPDATE 
						participantes_rsvp
					SET 
						part_hospedagem = ".$this->Db->qstr($valor_a).",
						part_hotel = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluhos; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}	
				
				$sqltra = "
					SELECT
						tra_id_evento,
						tra_cpf_particip,
						tra_status
					FROM
						transfer_rsvp
					WHERE
						tra_cpf_particip = ".$this->Db->qstr($cpf_mestre)."
					AND
						tra_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						tra_id_evento,tra_cpf_particip,tra_status
					LIMIT 1
				";
				 
      $nm_select = $sqltra; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rstra = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstra[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstra = false;
          $this->rstra_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rstra[0][0])) {
					$status_tra = $this->rstra[0][2];
					$sqlutra = "
					UPDATE 
						participantes_rsvp
					SET 
						part_transfer = ".$this->Db->qstr($status_tra)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqlutra; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqlutra = "
					UPDATE 
						participantes_rsvp
					SET 
						part_transfer = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqlutra; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}
								
				$sqlopc = "
					SELECT
						opc_evento_id,
						opc_cpf_participante,
						opc_status
					FROM
						eventos_opcionais_rsvp
					WHERE
						opc_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						opc_evento_id = ".$this->Db->qstr($evento_id)."
					AND
						opc_status = ".$this->Db->qstr($valor_y)."
					ORDER BY
						opc_evento_id,opc_cpf_participante	
					LIMIT 1	
				";
				 
      $nm_select = $sqlopc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsopc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsopc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsopc = false;
          $this->rsopc_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rsopc[0][0])) {
					$sqluopc = "
					UPDATE 
						participantes_rsvp
					SET 
						part_opcionais =  ".$this->Db->qstr($valor_y)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluopc; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqluopc = "
					UPDATE 
						participantes_rsvp
					SET 
						part_opcionais =  ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluopc; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}	
								
				$sqlant = "
					SELECT
						ant_evento_id,
						ant_cpf_participante,
						ant_status
					FROM
						anotacoes_rsvp	
					WHERE
						ant_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						ant_evento_id = ".$this->Db->qstr($evento_id)."		
					ORDER BY
						ant_evento_id,ant_cpf_participante		
					LIMIT 1	
				";
				 
      $nm_select = $sqlant; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsant = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsant[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsant = false;
          $this->rsant_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rsant[0][0])) {
					$sqluant = "
					UPDATE 
						participantes_rsvp
					SET 
						part_anotacoes = ".$this->Db->qstr($valor_y)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluant; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				} else {
					$sqluant = "
					UPDATE 
						participantes_rsvp
					SET 
						part_anotacoes = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluant; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
				}
			}	
		}
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function Mkprest($evento) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$valor_nao = 'N';
		$sqlu = "
		UPDATE
			participantes_rsvp
		SET
			part_anotacoes = ".$this->Db->qstr($valor_nao).",
			part_contato_rsvp = ".$this->Db->qstr($valor_nao).",
			part_solicit_especial = ".$this->Db->qstr($valor_nao).",
			part_programacao = ".$this->Db->qstr($valor_nao).",
			part_aereo = ".$this->Db->qstr($valor_nao).",
			part_hospedagem = ".$this->Db->qstr($valor_nao).",
			part_opcionais = ".$this->Db->qstr($valor_nao).",
			part_transfer = ".$this->Db->qstr($valor_nao).",
			part_atendimento = ".$this->Db->qstr($valor_nao).",
			part_aereo_ok = ".$this->Db->qstr($valor_nao).",
			part_hotel = ".$this->Db->qstr($valor_nao).",
			part_anotacoes = ".$this->Db->qstr($valor_nao)."
		WHERE
			part_id_evento = ".$this->Db->qstr($evento)."
		AND 	
			part_presenca = ".$this->Db->qstr($valor_nao)."	
		";
		
     $nm_select = $sqlu; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$fip_usuario = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$fip_usuario = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$fip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$fip_usuario = $_SERVER['REMOTE_ADDR'];
		}		
		return $fip_usuario;
	
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}

}

?>
