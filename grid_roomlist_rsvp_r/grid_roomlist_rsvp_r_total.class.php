<?php

class grid_roomlist_rsvp_r_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_roomlist_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_roomlist_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->hospede = (isset($Busca_temp['hospede'])) ? $Busca_temp['hospede'] : ""; 
          $tmp_pos = (is_string($this->hospede)) ? strpos($this->hospede, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospede))
          {
              $this->hospede = substr($this->hospede, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->passaporte = (isset($Busca_temp['passaporte'])) ? $Busca_temp['passaporte'] : ""; 
          $tmp_pos = (is_string($this->passaporte)) ? strpos($this->passaporte, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->passaporte))
          {
              $this->passaporte = substr($this->passaporte, 0, $tmp_pos);
          }
          $this->cod_publico = (isset($Busca_temp['cod_publico'])) ? $Busca_temp['cod_publico'] : ""; 
          $tmp_pos = (is_string($this->cod_publico)) ? strpos($this->cod_publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_publico))
          {
              $this->cod_publico = substr($this->cod_publico, 0, $tmp_pos);
          }
          $this->publico_dsc = (isset($Busca_temp['publico_dsc'])) ? $Busca_temp['publico_dsc'] : ""; 
          $tmp_pos = (is_string($this->publico_dsc)) ? strpos($this->publico_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_dsc))
          {
              $this->publico_dsc = substr($this->publico_dsc, 0, $tmp_pos);
          }
          $this->cod_hotel = (isset($Busca_temp['cod_hotel'])) ? $Busca_temp['cod_hotel'] : ""; 
          $tmp_pos = (is_string($this->cod_hotel)) ? strpos($this->cod_hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_hotel))
          {
              $this->cod_hotel = substr($this->cod_hotel, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->cod_acomodacao = (isset($Busca_temp['cod_acomodacao'])) ? $Busca_temp['cod_acomodacao'] : ""; 
          $tmp_pos = (is_string($this->cod_acomodacao)) ? strpos($this->cod_acomodacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_acomodacao))
          {
              $this->cod_acomodacao = substr($this->cod_acomodacao, 0, $tmp_pos);
          }
          $this->acomodacao_dsc = (isset($Busca_temp['acomodacao_dsc'])) ? $Busca_temp['acomodacao_dsc'] : ""; 
          $tmp_pos = (is_string($this->acomodacao_dsc)) ? strpos($this->acomodacao_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->acomodacao_dsc))
          {
              $this->acomodacao_dsc = substr($this->acomodacao_dsc, 0, $tmp_pos);
          }
          $this->cod_categoria = (isset($Busca_temp['cod_categoria'])) ? $Busca_temp['cod_categoria'] : ""; 
          $tmp_pos = (is_string($this->cod_categoria)) ? strpos($this->cod_categoria, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_categoria))
          {
              $this->cod_categoria = substr($this->cod_categoria, 0, $tmp_pos);
          }
          $this->categoria_dsc = (isset($Busca_temp['categoria_dsc'])) ? $Busca_temp['categoria_dsc'] : ""; 
          $tmp_pos = (is_string($this->categoria_dsc)) ? strpos($this->categoria_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->categoria_dsc))
          {
              $this->categoria_dsc = substr($this->categoria_dsc, 0, $tmp_pos);
          }
          $this->voo_ida = (isset($Busca_temp['voo_ida'])) ? $Busca_temp['voo_ida'] : ""; 
          $tmp_pos = (is_string($this->voo_ida)) ? strpos($this->voo_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo_ida))
          {
              $this->voo_ida = substr($this->voo_ida, 0, $tmp_pos);
          }
          $this->cod_cia_ida = (isset($Busca_temp['cod_cia_ida'])) ? $Busca_temp['cod_cia_ida'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_ida)) ? strpos($this->cod_cia_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_ida))
          {
              $this->cod_cia_ida = substr($this->cod_cia_ida, 0, $tmp_pos);
          }
          $this->dt_checkin = (isset($Busca_temp['dt_checkin'])) ? $Busca_temp['dt_checkin'] : ""; 
          $tmp_pos = (is_string($this->dt_checkin)) ? strpos($this->dt_checkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dt_checkin))
          {
              $this->dt_checkin = substr($this->dt_checkin, 0, $tmp_pos);
          }
          $dt_checkin_2 = (isset($Busca_temp['dt_checkin_input_2'])) ? $Busca_temp['dt_checkin_input_2'] : ""; 
          $this->dt_checkin_2 = $dt_checkin_2; 
          $this->hr_transferin = (isset($Busca_temp['hr_transferin'])) ? $Busca_temp['hr_transferin'] : ""; 
          $tmp_pos = (is_string($this->hr_transferin)) ? strpos($this->hr_transferin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hr_transferin))
          {
              $this->hr_transferin = substr($this->hr_transferin, 0, $tmp_pos);
          }
          $this->voo_volta = (isset($Busca_temp['voo_volta'])) ? $Busca_temp['voo_volta'] : ""; 
          $tmp_pos = (is_string($this->voo_volta)) ? strpos($this->voo_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo_volta))
          {
              $this->voo_volta = substr($this->voo_volta, 0, $tmp_pos);
          }
          $this->cod_cia_volta = (isset($Busca_temp['cod_cia_volta'])) ? $Busca_temp['cod_cia_volta'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_volta)) ? strpos($this->cod_cia_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_volta))
          {
              $this->cod_cia_volta = substr($this->cod_cia_volta, 0, $tmp_pos);
          }
          $this->forma_pgto = (isset($Busca_temp['forma_pgto'])) ? $Busca_temp['forma_pgto'] : ""; 
          $tmp_pos = (is_string($this->forma_pgto)) ? strpos($this->forma_pgto, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->forma_pgto))
          {
              $this->forma_pgto = substr($this->forma_pgto, 0, $tmp_pos);
          }
          $this->dt_checkout = (isset($Busca_temp['dt_checkout'])) ? $Busca_temp['dt_checkout'] : ""; 
          $tmp_pos = (is_string($this->dt_checkout)) ? strpos($this->dt_checkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dt_checkout))
          {
              $this->dt_checkout = substr($this->dt_checkout, 0, $tmp_pos);
          }
          $dt_checkout_2 = (isset($Busca_temp['dt_checkout_input_2'])) ? $Busca_temp['dt_checkout_input_2'] : ""; 
          $this->dt_checkout_2 = $dt_checkout_2; 
          $this->intervalo_trout = (isset($Busca_temp['intervalo_trout'])) ? $Busca_temp['intervalo_trout'] : ""; 
          $tmp_pos = (is_string($this->intervalo_trout)) ? strpos($this->intervalo_trout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->intervalo_trout))
          {
              $this->intervalo_trout = substr($this->intervalo_trout, 0, $tmp_pos);
          }
          $this->hr_transferout = (isset($Busca_temp['hr_transferout'])) ? $Busca_temp['hr_transferout'] : ""; 
          $tmp_pos = (is_string($this->hr_transferout)) ? strpos($this->hr_transferout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hr_transferout))
          {
              $this->hr_transferout = substr($this->hr_transferout, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->tipo_transfer = (isset($Busca_temp['tipo_transfer'])) ? $Busca_temp['tipo_transfer'] : ""; 
          $tmp_pos = (is_string($this->tipo_transfer)) ? strpos($this->tipo_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_transfer))
          {
              $this->tipo_transfer = substr($this->tipo_transfer, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(cpf) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(cpf) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(cpf) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['tot_geral'][2] = $rt->fields[1]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['contr_total_geral'] = "OK";
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

function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function PrepRoom2($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';	
		$valor_y = 'Y';
		$valor_s = 'SIM';
		$valor_n = 'N';		
		
		if ($vp_tipoPessoa == 'P') {                                                                                      
			$sqld="                                                                                                          
			DELETE FROM                                                                                                      
				roomlist_rsvp_r
			WHERE                                                                                                            
				cod_evento = ".$this->Db->qstr($vp_evento)."                                                                                    
			AND                                                                                                              
				id_usuario_relato = ".$this->Db->qstr($vp_usuario)."                                                                           
			";	                                                                                                              
			
     $nm_select = $sqld; 
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
		                                                                                 
		}	
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			transfer_rsvp.tra_numvoo_ida,	                
			transfer_rsvp.tra_cia_ida,   		  
			transfer_rsvp.tra_hr_chegada_ida,
			transfer_rsvp.tra_numvoo_volta,                 
			transfer_rsvp.tra_cia_volta,		            
			transfer_rsvp.tra_hr_saida_volta, 	            
			transfer_rsvp.tra_hrtransout,		            
			transfer_rsvp.tra_tipo,	
			transfer_rsvp.tra_direcao,	
			transfer_rsvp.tra_id_hotel,
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		RIGHT JOIN
			transfer_rsvp
		ON
			transfer_rsvp.tra_cpf_particip = hospedagem_rsvp.hosp_cpf_participante		
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)." 	
		AND
			hospedagem_rsvp.conta_roomlist = ".$this->Db->qstr($valor_s)." 
		AND
			transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)." 
		AND
			transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."						
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;			                                                                                          
		 
      $nm_select = $sqlMestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsm = false;
          $this->rsm_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
                                                                                    
		$reg_mestre = sizeof($this->rsm );		                                                                                    
		if ($reg_mestre > 0) {					
			for ($i=0;$i<$reg_mestre;++$i) {				
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';								
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				
				$w_hosp_cpf_participante	= $this->rsm[$i][0];		
				$w_hosp_id_evento		    = $this->rsm[$i][1];     
				$w_hosp_acompanhante	    = $this->rsm[$i][2];     
				$w_hosp_part_acomp     	    = $this->rsm[$i][3];     
				$w_hosp_id_hotel		    = $this->rsm[$i][4];     
				$w_hosp_acomodacao		 	= $this->rsm[$i][5];     
				$w_hosp_categoria  		    = $this->rsm[$i][6];     
				$w_hosp_dt_checkin		 	= $this->rsm[$i][7];     
				$w_hosp_dt_checkout   	 	= $this->rsm[$i][8];     
				$w_hosp_early_chkin  	    = $this->rsm[$i][9];     
				$w_hosp_late_chkout 	    = $this->rsm[$i][10];    
				$w_hosp_pagamentos 		    = $this->rsm[$i][11];    
				$w_hosp_observacoes		    = $this->rsm[$i][12];    
				$w_hosp_dsc_pacote          = $this->rsm[$i][13];    
				$w_tra_numvoo_ida	        = $this->rsm[$i][14];	
				$w_tra_cia_ida   		    = $this->rsm[$i][15];	
				$w_tra_hr_saida_ida         = $this->rsm[$i][16];	
				$w_tra_numvoo_volta         = $this->rsm[$i][17];	
				$w_tra_cia_volta		    = $this->rsm[$i][18];	
				$w_tra_hr_saida_volta 	  	= $this->rsm[$i][19];    
				$w_tra_hrtransout		    = $this->rsm[$i][20];	
				$w_tra_tipotransfer			= $this->rsm[$i][21];    
				$f_tra_direcao				= $this->rsm[$i][22];	
				$f_tra_id_hotel				= $this->rsm[$i][23];    
				$w_hosp_acmq_01				= $this->rsm[$i][24];	
				$w_hosp_acmq_02				= $this->rsm[$i][25];    
				$w_hosp_acmq_03				= $this->rsm[$i][26];    
				$w_hosp_acmq_04				= $this->rsm[$i][27];    
				$w_hosp_pamq_01				= $this->rsm[$i][28];    
				$w_hosp_pamq_02				= $this->rsm[$i][29];    
				$w_hosp_pamq_03				= $this->rsm[$i][30];    
				$w_hosp_pamq_04				= $this->rsm[$i][31];	

				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspart[0][0])) {											
					$w_nome				   		= $this->rspart[0][0];			  	             
					$w_part_passaporte     		= $this->rspart[0][1];    	     
					$w_part_rg             		= $this->rspart[0][2];    	
					$w_part_dt_nasc        		= $this->rspart[0][3];  	
					$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
					$w_part_celeular_01      	= $this->rspart[0][5]; 
					$w_part_email            	= $this->rspart[0][6];    
					$w_part_id_evento_publico	= $this->rspart[0][7];   
					$w_empresa					= $this->rspart[0][9];
					$w_grupo					= $this->rspart[0][10];
					$w_cargo					= $this->rspart[0][11];
					$w_tipopess 				= 'PARTICIPANTE';
					$w_foneinter				= $this->rspart[0][12];
					$w_dsc_emp_rsvp				= $this->rspart[0][13];					
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."			
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspart[0][0])) {											
						$w_nome				   		= $this->rspart[0][0];			  	             
						$w_part_passaporte     		= $this->rspart[0][1];    	     
						$w_part_rg             		= $this->rspart[0][2];    	
						$w_part_dt_nasc        		= $this->rspart[0][3];  	
						$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
						$w_part_celeular_01      	= $this->rspart[0][5]; 
						$w_part_email            	= $this->rspart[0][6];    
						$w_part_id_evento_publico	= $this->rspart[0][7];  
						$w_empresa					= $this->rspart[0][9];
						$w_grupo					= $this->rspart[0][10];
						$w_cargo					= $this->rspart[0][11];
						$w_tipopess 				= 'ACOMPANHANTE';
						$w_foneinter				= $this->rspart[0][12];
						$w_dsc_emp_rsvp				= $this->rspart[0][13];
					}					
				}		
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
					$w_foneinter = '';
				}	
				$sqlUsu = "								                                                                                             
				SELECT                                                                                                          
					usuario_id,                                                                                                    
					usuario_nome                                                                                                   
				FROM                                                                                                            
					usuarios_rsvp                                                                                                  
					WHERE                                                                                                          
					usuario_id = ".$this->Db->qstr($vp_usuario)."                                                                                 
				ORDER BY                                                                                                        
					usuario_id                                                                                                     
				";		                                                                                                            
				 
      $nm_select = $sqlUsu; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsusu = false;
          $this->rsusu_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsusu[0][0])) {									                                                                            
					$w_usurelDsc = $this->rsusu[0][1];                                                                                  
				} else {                                                                                                        
					$w_usurelDsc = "";				                                                                                         
				}		                                                                                                             
				switch($w_tra_tipotransfer) {                                                                                      
					case 'A':                                                                                                      
						$w_tra_tipotransfer = 'AEREO';  		                                                                               
						break;                                                                                                        
					case 'L':                                                                                                      
						$w_tra_tipotransfer	= 'LOCAL';                                                                                   
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_tra_tipotransfer	= 'PROPRIO';                                                                                 
						break;	                                                                                                       
				}                                                                                                              
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
				ORDER BY                                                                                                        
					evento_id         					
				";		                                                                                                            
				 
      $nm_select = $sqlEve; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rseve = false;
          $this->rseve_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rseve[0][0])) {									                                                                            
					$w_eventoDsc = $this->rseve[0][1];                                                                                  
				} else {                                                                                                        
					$w_eventoDsc = "";				                                                                                         
				}		                                                                                                           
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspgt = false;
          $this->rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $this->rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($w_tra_cia_ida)."                                                                                 
				ORDER BY                                                                                                        
					cia_id
				";		                                                                                                            
				 
      $nm_select = $sqlCia; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscia = false;
          $this->rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscia[0][0])) {									                                                                            
					$w_ciaida = $this->rscia[0][1];                                                                                  
				} else {                                                                                                        
					$w_ciaida = "";				                                                                                         
				}		
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($w_tra_cia_volta)."                                                                                 
				ORDER BY                                                                                                        
					cia_id
				";		                                                                                                            
				 
      $nm_select = $sqlCia; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscia = false;
          $this->rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscia[0][0])) {									                                                                            
					$w_ciavolta = $this->rscia[0][1];                                                                                  
				} else {                                                                                                        
					$w_ciavolta = "";				                                                                                         
				}					
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaco = false;
          $this->rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsaco[0][0])) {									                                                                            
					$w_acomodacao = $this->rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscat = false;
          $this->rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscat[0][0])) {									                                                                            
					$w_categoria = $this->rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
				ORDER BY                                                                                                        
					publico_id
				";		                                                                                                            
				 
      $nm_select = $sqlPub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspub = false;
          $this->rspub_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspub[0][0])) {									                                                                            
					$w_publico = $this->rspub[0][1];                                                                                  
				} else {                                                                                                        
					$w_publico = "";				                                                                                         
				}
				$sqlHot = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
				ORDER BY                                                                                                        
					hotel_id
				";		                                                                                                            
				 
      $nm_select = $sqlHot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshot = false;
          $this->rshot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshot[0][0])) {									                                                                            
					$w_hotel_dsc = $this->rshot[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc = "";				                                                                                         
				}					
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsanot = false;
          $this->rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsanot[0][0])) {
					$w_anotacao = $this->rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				$w_acompanhado = "";
				if ($w_tipopess  == 'ACOMPANHANTE') {						
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspacm = false;
          $this->rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $this->rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspcpf = false;
          $this->rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($this->rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $this->rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}					
				     				
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_01		= $this->rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_acmq_rg_01		= $this->rsplhac[0][3];
						$w_acmq_docest_01	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_02		= $this->rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_acmq_rg_02		= $this->rsplhac[0][3];
						$w_acmq_docest_02	= $this->rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_03		= $this->rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_acmq_rg_03		= $this->rsplhac[0][3];
						$w_acmq_docest_03	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_04		= $this->rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_acmq_rg_04		= $this->rsplhac[0][3];
						$w_acmq_docest_04	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_01		= $this->rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_pamq_rg_01		= $this->rsplhac[0][3];
						$w_pamq_docest_01	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_02		= $this->rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_02	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_03		= $this->rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_pamq_rg_03		= $this->rsplhac[0][3];
						$w_pamq_docest_03	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_04		= $this->rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_04	= $this->rsplhac[0][4];				
					}										
				}	
				
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsnoinc = false;
          $this->rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				
				
				if ($inclui == 'S' && $w_nome <> '') {					
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($wW_pamq_dtnasc_04).",
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
						
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function PrepRoom3($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';
		$valor_y = 'Y';			                                                                                        
		$valor_s = 'SIM';
		$valor_n = 'N';
		$valor_exclui = 'ANHANTE';
		
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)."	
		AND
			hospedagem_rsvp.conta_roomlist= ".$this->Db->qstr($valor_s)."
		AND	
			hospedagem_rsvp.acmq_01 <> ".$this->Db->qstr($valor_exclui)."
		AND	
			hospedagem_rsvp.acmq_02 <> ".$this->Db->qstr($valor_exclui)."
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;
		 
      $nm_select = $sqlMestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsm = false;
          $this->rsm_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
                                                                                    
		$reg_mestre = sizeof($this->rsm );		                                                                                    
		if ($reg_mestre > 0) {				                                                                                        
			for ($i=0;$i<$reg_mestre;++$i) {				
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';				
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				 				
				$w_hosp_cpf_participante	= $this->rsm[$i][0];		     					                 
				$w_hosp_id_evento		    = $this->rsm[$i][1];               
				$w_hosp_acompanhante	    = $this->rsm[$i][2];            
				$w_hosp_part_acomp     	    = $this->rsm[$i][3];            
				$w_hosp_id_hotel		    = $this->rsm[$i][4];                  
				$w_hosp_acomodacao		 	= $this->rsm[$i][5];              
				$w_hosp_categoria  		    = $this->rsm[$i][6];              
				$w_hosp_dt_checkin		 	= $this->rsm[$i][7];            	   		
				$w_hosp_dt_checkout   	 	= $this->rsm[$i][8];           
				$w_hosp_early_chkin  	    = $this->rsm[$i][9];           
				$w_hosp_late_chkout 	    = $this->rsm[$i][10];           
				$w_hosp_pagamentos 		    = $this->rsm[$i][11];            
				$w_hosp_observacoes		    = $this->rsm[$i][12];             
				$w_hosp_dsc_pacote          = $this->rsm[$i][13];               
				$w_hosp_acmq_01				= $this->rsm[$i][14];	
				$w_hosp_acmq_02				= $this->rsm[$i][15];    
				$w_hosp_acmq_03				= $this->rsm[$i][16];    
				$w_hosp_acmq_04				= $this->rsm[$i][17];    
				$w_hosp_pamq_01				= $this->rsm[$i][18];    
				$w_hosp_pamq_02				= $this->rsm[$i][19];    
				$w_hosp_pamq_03				= $this->rsm[$i][20];    
				$w_hosp_pamq_04				= $this->rsm[$i][21];	  							
			
				$w_tra_numvoo_ida	        = '';	
				$w_tra_cia_ida   		    = '';	
				$w_tra_hr_saida_ida         = '';	
				$w_tra_numvoo_volta         = '';	
				$w_tra_cia_volta		    = '';	
				$w_tra_hr_saida_volta 	  	= '';   
				$w_tra_hrtransout		    = '';	
				$w_tra_tipotransfer			= '';   
				$f_tra_direcao				= '';	
				$f_tra_id_hotel				= '';   
				
				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."	
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspart[0][0])) {											
					$w_nome				   		= $this->rspart[0][0];			  	             
					$w_part_passaporte     		= $this->rspart[0][1];    	     
					$w_part_rg             		= $this->rspart[0][2];    	
					$w_part_dt_nasc        		= $this->rspart[0][3];  	
					$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
					$w_part_celeular_01      	= $this->rspart[0][5]; 
					$w_part_email            	= $this->rspart[0][6];    
					$w_part_id_evento_publico	= $this->rspart[0][7];   	
					$w_empresa					= $this->rspart[0][9]; 
					$w_grupo					= $this->rspart[0][10]; 
					$w_cargo					= $this->rspart[0][11]; 
					$w_tipopess = 'PARTICIPANTE';		
					$w_foneinter				= $this->rspart[0][12];
					$w_dsc_emp_rsvp				= $this->rspart[0][13];
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."		
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspart[0][0])) {											
						$w_nome				   		= $this->rspart[0][0];			  	             
						$w_part_passaporte     		= $this->rspart[0][1];    	     
						$w_part_rg             		= $this->rspart[0][2];    	
						$w_part_dt_nasc        		= $this->rspart[0][3];  	
						$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
						$w_part_celeular_01      	= $this->rspart[0][5]; 
						$w_part_email            	= $this->rspart[0][6];    
						$w_part_id_evento_publico	= $this->rspart[0][7]; 
						$w_empresa					= $this->rspart[0][9];
						$w_grupo					= $this->rspart[0][10]; 
						$w_cargo					= $this->rspart[0][11]; 
						$w_tipopess = 'ACOMPANHANTE';			
						$w_foneinter				= $this->rspart[0][12];
						$w_dsc_emp_rsvp				= $this->rspart[0][13];
					}	
				}	
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
					$w_foneinter = '';
				}	
				$sqlUsu = "								                                                                                             
				SELECT                                                                                                          
					usuario_id,                                                                                                    
					usuario_nome                                                                                                   
				FROM                                                                                                            
					usuarios_rsvp                                                                                                  
					WHERE                                                                                                          
					usuario_id = ".$this->Db->qstr($vp_usuario)."                                                                                 
				ORDER BY                                                                                                        
					usuario_id                                                                                                     
				";		                                                                                                            
				 
      $nm_select = $sqlUsu; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsusu = false;
          $this->rsusu_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsusu[0][0])) {									                                                                            
					$w_usurelDsc = $this->rsusu[0][1];                                                                                  
				} else {                                                                                                        
					$w_usurelDsc = "";				                                                                                         
				}		                                                                                                             
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
				ORDER BY                                                                                                        
					evento_id         					
				";		                                                                                                            
				 
      $nm_select = $sqlEve; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rseve = false;
          $this->rseve_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rseve[0][0])) {									                                                                            
					$w_eventoDsc = $this->rseve[0][1];                                                                                  
				} else {                                                                                                        
					$w_eventoDsc = "";				                                                                                         
				}		                                                                                                           
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspgt = false;
          $this->rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $this->rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaco = false;
          $this->rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsaco[0][0])) {									                                                                            
					$w_acomodacao = $this->rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscat = false;
          $this->rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscat[0][0])) {									                                                                            
					$w_categoria = $this->rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
				ORDER BY                                                                                                        
					publico_id
				";		                                                                                                            
				 
      $nm_select = $sqlPub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspub = false;
          $this->rspub_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspub[0][0])) {									                                                                            
					$w_publico = $this->rspub[0][1];                                                                                  
				} else {                                                                                                        
					$w_publico = "";				                                                                                         
				}
				$sqlHot = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
				ORDER BY                                                                                                        
					hotel_id
				";		                                                                                                            
				 
      $nm_select = $sqlHot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshot = false;
          $this->rshot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshot[0][0])) {									                                                                            
					$w_hotel_dsc = $this->rshot[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc = "";				                                                                                         
				}					
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsanot = false;
          $this->rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsanot[0][0])) {
					$w_anotacao = $this->rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				
				$w_acompanhado = "";
				if ($w_tipopess == 'PARTICIPANTE') { 	 					
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspacm = false;
          $this->rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $this->rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspcpf = false;
          $this->rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($this->rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $this->rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}				
								
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_01		= $this->rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_acmq_rg_01		= $this->rsplhac[0][3];
						$w_acmq_docest_01	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_02		= $this->rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_acmq_rg_02		= $this->rsplhac[0][3];
						$w_acmq_docest_02	= $this->rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_03		= $this->rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_acmq_rg_03		= $this->rsplhac[0][3];
						$w_acmq_docest_03	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_04		= $this->rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_acmq_rg_04		= $this->rsplhac[0][3];
						$w_acmq_docest_04	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_01		= $this->rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_pamq_rg_01		= $this->rsplhac[0][3];
						$w_pamq_docest_01	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_02		= $this->rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_02	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_03		= $this->rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_pamq_rg_03		= $this->rsplhac[0][3];
						$w_pamq_docest_03	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_04		= $this->rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_04	= $this->rsplhac[0][4];				
					}										
				}	
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."	
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."	
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsnoinc = false;
          $this->rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				if ($inclui == 'S' && $w_nome <> '') {	
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($w_pamq_dtnasc_04).",	
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
					
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}

}

?>
