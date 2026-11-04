<?php

class grid_hospedagem_rsvp_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_hospedagem_rsvp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_hospedagem_rsvp']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->hospedagem_id = (isset($Busca_temp['hospedagem_id'])) ? $Busca_temp['hospedagem_id'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_id)) ? strpos($this->hospedagem_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_id))
          {
              $this->hospedagem_id = substr($this->hospedagem_id, 0, $tmp_pos);
          }
          $this->hosp_id_hotel = (isset($Busca_temp['hosp_id_hotel'])) ? $Busca_temp['hosp_id_hotel'] : ""; 
          $tmp_pos = (is_string($this->hosp_id_hotel)) ? strpos($this->hosp_id_hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_id_hotel))
          {
              $this->hosp_id_hotel = substr($this->hosp_id_hotel, 0, $tmp_pos);
          }
          $this->hosp_status = (isset($Busca_temp['hosp_status'])) ? $Busca_temp['hosp_status'] : ""; 
          $tmp_pos = (is_string($this->hosp_status)) ? strpos($this->hosp_status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_status))
          {
              $this->hosp_status = substr($this->hosp_status, 0, $tmp_pos);
          }
          $this->hosp_categoria = (isset($Busca_temp['hosp_categoria'])) ? $Busca_temp['hosp_categoria'] : ""; 
          $tmp_pos = (is_string($this->hosp_categoria)) ? strpos($this->hosp_categoria, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_categoria))
          {
              $this->hosp_categoria = substr($this->hosp_categoria, 0, $tmp_pos);
          }
          $this->hosp_acomodacao = (isset($Busca_temp['hosp_acomodacao'])) ? $Busca_temp['hosp_acomodacao'] : ""; 
          $tmp_pos = (is_string($this->hosp_acomodacao)) ? strpos($this->hosp_acomodacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_acomodacao))
          {
              $this->hosp_acomodacao = substr($this->hosp_acomodacao, 0, $tmp_pos);
          }
          $this->hosp_dt_checkin = (isset($Busca_temp['hosp_dt_checkin'])) ? $Busca_temp['hosp_dt_checkin'] : ""; 
          $tmp_pos = (is_string($this->hosp_dt_checkin)) ? strpos($this->hosp_dt_checkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_dt_checkin))
          {
              $this->hosp_dt_checkin = substr($this->hosp_dt_checkin, 0, $tmp_pos);
          }
          $hosp_dt_checkin_2 = (isset($Busca_temp['hosp_dt_checkin_input_2'])) ? $Busca_temp['hosp_dt_checkin_input_2'] : ""; 
          $this->hosp_dt_checkin_2 = $hosp_dt_checkin_2; 
          $this->hosp_dt_checkout = (isset($Busca_temp['hosp_dt_checkout'])) ? $Busca_temp['hosp_dt_checkout'] : ""; 
          $tmp_pos = (is_string($this->hosp_dt_checkout)) ? strpos($this->hosp_dt_checkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_dt_checkout))
          {
              $this->hosp_dt_checkout = substr($this->hosp_dt_checkout, 0, $tmp_pos);
          }
          $hosp_dt_checkout_2 = (isset($Busca_temp['hosp_dt_checkout_input_2'])) ? $Busca_temp['hosp_dt_checkout_input_2'] : ""; 
          $this->hosp_dt_checkout_2 = $hosp_dt_checkout_2; 
          $this->hosp_dsc_pacote = (isset($Busca_temp['hosp_dsc_pacote'])) ? $Busca_temp['hosp_dsc_pacote'] : ""; 
          $tmp_pos = (is_string($this->hosp_dsc_pacote)) ? strpos($this->hosp_dsc_pacote, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_dsc_pacote))
          {
              $this->hosp_dsc_pacote = substr($this->hosp_dsc_pacote, 0, $tmp_pos);
          }
          $this->hosp_id_evento = (isset($Busca_temp['hosp_id_evento'])) ? $Busca_temp['hosp_id_evento'] : ""; 
          $tmp_pos = (is_string($this->hosp_id_evento)) ? strpos($this->hosp_id_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_id_evento))
          {
              $this->hosp_id_evento = substr($this->hosp_id_evento, 0, $tmp_pos);
          }
          $this->hosp_id_usuario = (isset($Busca_temp['hosp_id_usuario'])) ? $Busca_temp['hosp_id_usuario'] : ""; 
          $tmp_pos = (is_string($this->hosp_id_usuario)) ? strpos($this->hosp_id_usuario, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_id_usuario))
          {
              $this->hosp_id_usuario = substr($this->hosp_id_usuario, 0, $tmp_pos);
          }
          $this->hosp_cpf_participante = (isset($Busca_temp['hosp_cpf_participante'])) ? $Busca_temp['hosp_cpf_participante'] : ""; 
          $tmp_pos = (is_string($this->hosp_cpf_participante)) ? strpos($this->hosp_cpf_participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_cpf_participante))
          {
              $this->hosp_cpf_participante = substr($this->hosp_cpf_participante, 0, $tmp_pos);
          }
          $this->hosp_ativo = (isset($Busca_temp['hosp_ativo'])) ? $Busca_temp['hosp_ativo'] : ""; 
          $tmp_pos = (is_string($this->hosp_ativo)) ? strpos($this->hosp_ativo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hosp_ativo))
          {
              $this->hosp_ativo = substr($this->hosp_ativo, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $hosp_id_hotel, $hosp_id_evento, $hosp_id_usuario;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_hospedagem_rsvp']['contr_total_geral'] = "OK";
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
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'off';
}


function GetSaldoHotel($evento_id,$id_hotel) {
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'on';
  	
	date_default_timezone_set('America/Sao_Paulo');
	$valor_y = 'Y';		
	$valor_zero = '0';
	$ret = 0;
	$valor_room = 'SIM';
		
	$sql = "
	SELECT
		bh_id_evento,		
		bh_id_hotel,			
		bh_acomodacao,		
		bh_categoria,		
		bh_qtd_quartos,		
		bh_saldo_quartos,
		id_bh_hotel
	FROM	
		bloqueio_hoteis_rsvp
	WHERE	
		bh_id_evento = ".$this->Db->qstr($evento_id)."	
	AND 
	    bh_id_hotel = ".$this->Db->qstr($id_hotel)."	
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
	             
	$reg_mestre = sizeof($this->rs );
	
	if ($reg_mestre > 0) {			
		for ($i=0;$i<$reg_mestre;++$i) {	
			$evento 	= $this->rs[$i][0];
			$hotel		= $this->rs[$i][1];
			$acomoda	= $this->rs[$i][2];
			$categor	= $this->rs[$i][3];
			$qtdquar	= $this->rs[$i][4];
			$salquar	= $this->rs[$i][5];
			$codbloq    = $this->rs[$i][6];
			
			$sqlbh = "
			SELECT    
				COUNT(hospedagem_id) as qtde,
				conta_roomlist
			FROM
				hospedagem_rsvp		
			WHERE 
				hosp_id_evento = ".$this->Db->qstr($evento)." 
			AND 
				hosp_id_hotel = ".$this->Db->qstr($hotel)."
			AND  
				hosp_acomodacao = ".$this->Db->qstr($acomoda)." 
			AND  
				hosp_categoria = ".$this->Db->qstr($categor)." 
			AND
				hosp_status = ".$this->Db->qstr($valor_y)."		
			AND 	
				conta_roomlist = ".$this->Db->qstr($valor_room)."	
			AND
				id_bloqueio_hotel = ".$this->Db->qstr($codbloq)."	
			";	
			 
      $nm_select = $sqlbh; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs2 = false;
          $this->rs2_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($this->rs2[0][0])) {
				$qtdeachou = $this->rs2[0][0];				
				$saldo = $qtdquar - $qtdeachou;
				$ret = $saldo; 				
			} else {
				$qtdeachou = 0;
				$ret = 0;
			}	
			
			if ($qtdeachou > 0) {						
				$sqlbh2 = "
				UPDATE
					bloqueio_hoteis_rsvp 
				SET
					bh_saldo_quartos = ".$this->Db->qstr($saldo)."				
				WHERE
					bh_id_evento = ".$this->Db->qstr($evento)."		
				AND
					bh_id_hotel = ".$this->Db->qstr($hotel)."
				AND
					bh_acomodacao = ".$this->Db->qstr($acomoda)."
				AND
					bh_categoria = ".$this->Db->qstr($categor)."	
				AND
					id_bh_hotel = ".$this->Db->qstr($codbloq)."	
				";
				
     $nm_select = $sqlbh2; 
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
	return $ret;
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_hospedagem_rsvp']['contr_erro'] = 'off';
}

}

?>
