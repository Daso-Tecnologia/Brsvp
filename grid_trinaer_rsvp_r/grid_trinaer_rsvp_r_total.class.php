<?php

class grid_trinaer_rsvp_r_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_trinaer_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_trinaer_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cia_aerea_sigla = (isset($Busca_temp['cia_aerea_sigla'])) ? $Busca_temp['cia_aerea_sigla'] : ""; 
          $tmp_pos = (is_string($this->cia_aerea_sigla)) ? strpos($this->cia_aerea_sigla, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cia_aerea_sigla))
          {
              $this->cia_aerea_sigla = substr($this->cia_aerea_sigla, 0, $tmp_pos);
          }
          $this->num_voo = (isset($Busca_temp['num_voo'])) ? $Busca_temp['num_voo'] : ""; 
          $tmp_pos = (is_string($this->num_voo)) ? strpos($this->num_voo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->num_voo))
          {
              $this->num_voo = substr($this->num_voo, 0, $tmp_pos);
          }
          $this->origem_sigla = (isset($Busca_temp['origem_sigla'])) ? $Busca_temp['origem_sigla'] : ""; 
          $tmp_pos = (is_string($this->origem_sigla)) ? strpos($this->origem_sigla, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->origem_sigla))
          {
              $this->origem_sigla = substr($this->origem_sigla, 0, $tmp_pos);
          }
          $this->destino_sigla = (isset($Busca_temp['destino_sigla'])) ? $Busca_temp['destino_sigla'] : ""; 
          $tmp_pos = (is_string($this->destino_sigla)) ? strpos($this->destino_sigla, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->destino_sigla))
          {
              $this->destino_sigla = substr($this->destino_sigla, 0, $tmp_pos);
          }
          $this->participante = (isset($Busca_temp['participante'])) ? $Busca_temp['participante'] : ""; 
          $tmp_pos = (is_string($this->participante)) ? strpos($this->participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante))
          {
              $this->participante = substr($this->participante, 0, $tmp_pos);
          }
          $this->publico_dsc = (isset($Busca_temp['publico_dsc'])) ? $Busca_temp['publico_dsc'] : ""; 
          $tmp_pos = (is_string($this->publico_dsc)) ? strpos($this->publico_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_dsc))
          {
              $this->publico_dsc = substr($this->publico_dsc, 0, $tmp_pos);
          }
          $this->regional_dsc = (isset($Busca_temp['regional_dsc'])) ? $Busca_temp['regional_dsc'] : ""; 
          $tmp_pos = (is_string($this->regional_dsc)) ? strpos($this->regional_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional_dsc))
          {
              $this->regional_dsc = substr($this->regional_dsc, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->comprado_belvitur = (isset($Busca_temp['comprado_belvitur'])) ? $Busca_temp['comprado_belvitur'] : ""; 
          $tmp_pos = (is_string($this->comprado_belvitur)) ? strpos($this->comprado_belvitur, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->comprado_belvitur))
          {
              $this->comprado_belvitur = substr($this->comprado_belvitur, 0, $tmp_pos);
          }
          $this->localizador = (isset($Busca_temp['localizador'])) ? $Busca_temp['localizador'] : ""; 
          $tmp_pos = (is_string($this->localizador)) ? strpos($this->localizador, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->localizador))
          {
              $this->localizador = substr($this->localizador, 0, $tmp_pos);
          }
          $this->eticket = (isset($Busca_temp['eticket'])) ? $Busca_temp['eticket'] : ""; 
          $tmp_pos = (is_string($this->eticket)) ? strpos($this->eticket, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->eticket))
          {
              $this->eticket = substr($this->eticket, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['contr_total_geral'] = "OK";
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
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}


function PrepReltrin($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;
		$ret = 'ADICIONA ERRO';			
		$valor_y = 'Y';
		$valor_p = 'P';
		$valor_a = 'A';
		$valor_n = 'N';
		$valor_nu = '';
		$valor_direcao = 'IDA';
		$valor_tipo = 'IN';
	
		$nome_empresa = '';	
		if($vp_nivel == 'CONVIDADO') {
			$sqlconv = "
				SELECT
					evento_id,
					usuario_id,
					nome_empresa
				FROM
					eventos_usuarios_rsvp			
				WHERE	
					evento_id = ".$this->Db->qstr($vp_evento)."
				AND 
					usuario_id = ".$this->Db->qstr($vp_usuario)."	
			";
			 
      $nm_select = $sqlconv; 
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
				$nome_empresa = $this->rs[0][2];
			}
		}		
		
		if ($vp_tipoPessoa == 'P') {
			$sqld="
			DELETE FROM 
				trinaer_rsvp_r
			WHERE   
				id_evento = ".$this->Db->qstr($vp_evento)."
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
		if ($vp_tipoPessoa == 'P') {			
			if($vp_nivel == 'CONVIDADO') {
				$sqlMestre = "				
				SELECT
					participantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					participantes_rsvp.nome_pessoa AS p_nome,
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					participantes_rsvp.part_grupo AS p_grupo,  
					participantes_rsvp.part_departamento AS p_departamento,
					participantes_rsvp.part_cargo AS p_cargo,	
					participantes_rsvp.part_empresa AS p_empresa, 
					participantes_rsvp.part_email AS p_email,	
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					participantes_rsvp.part_celeular_01 AS p_celular_01, 
					participantes_rsvp.part_ddd_01 AS p_ddd_01,  
					participantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					participantes_rsvp.part_rg, 
					participantes_rsvp.part_cpf AS p_cpf, 
					participantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer,			
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,				
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans,
					participantes_rsvp.dsc_empresa_rsvp
					FROM 
						transfer_rsvp 
					RIGHT JOIN 
						participantes_rsvp 
					ON 
						transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf 						
					RIGHT JOIN 
						aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
					AND 
						aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
					WHERE 	
						transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 	  	
					AND
					   participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."  
					AND 
						transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	 
					AND	
						transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)."	 
					AND 
						transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."	 
					AND 
						transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 	
					AND 
						participantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."	
					AND 
						transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)."	
					AND                                                                	
						participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 											
					AND
						aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
					AND
						aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."		
					AND
						participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
					ORDER BY 
						participantes_rsvp.nome_pessoa							
				";	
			} else {
				$sqlMestre = "				
				SELECT
					participantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					participantes_rsvp.nome_pessoa AS p_nome,
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					participantes_rsvp.part_grupo AS p_grupo,  
					participantes_rsvp.part_departamento AS p_departamento,
					participantes_rsvp.part_cargo AS p_cargo,	
					participantes_rsvp.part_empresa AS p_empresa, 
					participantes_rsvp.part_email AS p_email,	
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					participantes_rsvp.part_celeular_01 AS p_celular_01, 
					participantes_rsvp.part_ddd_01 AS p_ddd_01,  
					participantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					participantes_rsvp.part_rg, 
					participantes_rsvp.part_cpf AS p_cpf, 
					participantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer,			
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,				
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans					
					FROM 
						transfer_rsvp 
					RIGHT JOIN 
						participantes_rsvp 
					ON 
						transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf 						
					RIGHT JOIN 
						aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
					AND 
						aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
					WHERE 	
						transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 	  	
					AND
					   participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."  
					AND 
						transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	 
					AND	
						transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)."	 
					AND 
						transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."	 
					AND 
						transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 	
					AND 
						participantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."	
					AND 
						transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)."	
					AND                                                                	
						participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 											
					AND
						aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
					AND
						aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."		
					ORDER BY 
						participantes_rsvp.nome_pessoa							
				";	
			}
			$_passa_part = true;
		} else {			
			if($vp_nivel == 'CONVIDADO') {
				$sqlMestre = "		                                                                   
				SELECT                                                                              
					acompanhantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					acompanhantes_rsvp.part_nome AS p_nome,
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					acompanhantes_rsvp.part_grupo AS p_grupo,  
					acompanhantes_rsvp.part_departamento AS p_departamento,
					acompanhantes_rsvp.part_cargo AS p_cargo,	
					acompanhantes_rsvp.part_empresa AS p_empresa, 
					acompanhantes_rsvp.part_email AS p_email,	
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01, 
					acompanhantes_rsvp.part_ddd_01 AS p_ddd_01,  
					acompanhantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					acompanhantes_rsvp.part_rg, 
					acompanhantes_rsvp.part_cpf AS p_cpf, 
					acompanhantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer, 				
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf			
				RIGHT JOIN 
					aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
				AND 
					aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
				WHERE
					transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND
				   acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND 
					transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	
				AND
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)."	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."				
				AND
					transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 
				AND                                                                     	
					acompanhantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."
				AND
					transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)." 	
				AND                                                               				
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 				
				AND
					aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
				AND
					aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."	
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY				 
					acompanhantes_rsvp.part_nome			
				";	
			} else {
				$sqlMestre = "		                                                                   
				SELECT                                                                              
					acompanhantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					acompanhantes_rsvp.part_nome AS p_nome,
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					acompanhantes_rsvp.part_grupo AS p_grupo,  
					acompanhantes_rsvp.part_departamento AS p_departamento,
					acompanhantes_rsvp.part_cargo AS p_cargo,	
					acompanhantes_rsvp.part_empresa AS p_empresa, 
					acompanhantes_rsvp.part_email AS p_email,	
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01, 
					acompanhantes_rsvp.part_ddd_01 AS p_ddd_01,  
					acompanhantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					acompanhantes_rsvp.part_rg, 
					acompanhantes_rsvp.part_cpf AS p_cpf, 
					acompanhantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer, 				
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans					
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf			
				RIGHT JOIN 
					aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
				AND 
					aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
				WHERE
					transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND
				   acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND 
					transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	
				AND
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)."	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."				
				AND
					transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 
				AND                                                                     	
					acompanhantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."
				AND
					transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)." 	
				AND                                                               				
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 				
				AND
					aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
				AND
					aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."	
				ORDER BY				 
					acompanhantes_rsvp.part_nome			
				";
			}
			$_passa_part == true;	
		}	
		 
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
				if ($vp_tipoPessoa == 'P') {
					$w_id_evento      	= $this->rsm[$i][0];
					$w_data_saida     	= $this->rsm[$i][1]; 
					$w_hora_saida     	= $this->rsm[$i][2]; 
					$w_data_chegada   	= $this->rsm[$i][3]; 
					$w_hora_chegada   	= $this->rsm[$i][4]; 
					$w_cia_aerea 	  	= $this->rsm[$i][5];
					$w_num_voo        	= $this->rsm[$i][34]; 
					$w_origem 		  	= $this->rsm[$i][7];
					$w_destino		  	= $this->rsm[$i][8]; 				
					$w_participante		= $this->rsm[$i][9];
					$w_publico		  	= $this->rsm[$i][10];
					$w_regional	      	= $this->rsm[$i][11];
					$w_hotel			= $this->rsm[$i][12];
					$w_grupo_dsc        = $this->rsm[$i][13];
					$w_depto_dsc        = $this->rsm[$i][14];
					$w_cargo_dsc        = $this->rsm[$i][15];
					$w_empresa_dsc      = $this->rsm[$i][16];
					$w_e_mail           = $this->rsm[$i][17];				
					$w_ddd_celular      = $this->rsm[$i][18];
					$w_celular          = $this->rsm[$i][19];
					$w_ddd_01           = $this->rsm[$i][20];
					$w_fone_01          = $this->rsm[$i][21];
					$w_localizador      = $this->rsm[$i][22];
					$w_eticket          = $this->rsm[$i][23];
					$w_rg               = $this->rsm[$i][24];
					$w_cpf              = $this->rsm[$i][25];
					$w_dtnasc           = $this->rsm[$i][26];
					$w_observacoes      = $this->rsm[$i][27];
					$w_tipo_transfer    = $this->rsm[$i][28];
					$w_status           = $this->rsm[$i][29];
					$w_cod_bloqueio     = $this->rsm[$i][30];
					$w_ativo            = $this->rsm[$i][31];					
					$w_tipo_pessoa  	= "PARTICIPANTE";					
				} else {
					$w_id_evento      	= $this->rsm[$i][0];
					$w_data_saida     	= $this->rsm[$i][1]; 
					$w_hora_saida     	= $this->rsm[$i][2]; 
					$w_data_chegada   	= $this->rsm[$i][3]; 
					$w_hora_chegada   	= $this->rsm[$i][4]; 
					$w_cia_aerea 	  	= $this->rsm[$i][5];
					$w_num_voo        	= $this->rsm[$i][34]; 
					$w_origem 		  	= $this->rsm[$i][7];
					$w_destino		  	= $this->rsm[$i][8]; 				
					$w_participante		= $this->rsm[$i][9];
					$w_publico		  	= $this->rsm[$i][10];
					$w_regional	      	= $this->rsm[$i][11];
					$w_hotel			= $this->rsm[$i][12];
					$w_grupo_dsc        = $this->rsm[$i][13];
					$w_depto_dsc        = $this->rsm[$i][14];
					$w_cargo_dsc        = $this->rsm[$i][15];
					$w_empresa_dsc      = $this->rsm[$i][16];
					$w_e_mail           = $this->rsm[$i][17];				
					$w_ddd_celular      = $this->rsm[$i][18];
					$w_celular          = $this->rsm[$i][19];
					$w_ddd_01           = $this->rsm[$i][20];
					$w_fone_01          = $this->rsm[$i][21];
					$w_localizador      = $this->rsm[$i][22];
					$w_eticket          = $this->rsm[$i][23];
					$w_rg               = $this->rsm[$i][24];
					$w_cpf              = $this->rsm[$i][25];
					$w_dtnasc           = $this->rsm[$i][26];
					$w_observacoes      = $this->rsm[$i][27];
					$w_tipo_transfer    = $this->rsm[$i][28];
					$w_status           = $this->rsm[$i][29];
					$w_cod_bloqueio     = $this->rsm[$i][30];
					$w_ativo            = $this->rsm[$i][31];					
					$w_tipo_pessoa  	= "ACOMPANHANTE";					
				}	
				$sqlAereo = "			
				SELECT
					aereo_id_evento,
					aereo_cpf_particip,
					aereo_emitida_bvt,
					aereo_bloqueio_id,
					aereo_localizador,
					aereo_num_voo,
					nota_gate,
					data_nota_gate,
					aereo_direcao					
				FROM
					aereos_rsvp
				WHERE
					aereo_id_evento = ".$this->Db->qstr($vp_evento)."
				AND
					aereo_cpf_particip = ".$this->Db->qstr($w_cpf)."
				AND
					aereo_localizador = ".$this->Db->qstr($w_localizador)."
				AND
					aereo_num_voo = ".$this->Db->qstr($w_num_voo)."
				ORDER BY
					aereo_id_evento,aereo_cpf_particip,aereo_localizador
				";
				 
      $nm_select = $sqlAereo; 
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
				
				if (isset($this->rsaer[0][0])) {					
					if ($this->rsaer[0][2] == 'Y') {
						$w_emitidaBvt = "SIM";
					} else {
						$w_emitidaBvt = "NAO";
					}
					$w_notaGate = $this->rsaer[0][6];
					$w_dtNotagate = $this->rsaer[0][7];
					$w_direcao = $this->rsaer[0][8];					
				} else {
					$w_emitidaBvt = "ERR";				
				}				
				$sqlCia = "			
				SELECT
					cia_id,
					cia_sigla,
					cia_nome
				FROM
					tbl_cia_aereas
				WHERE
					cia_id = ".$this->Db->qstr($w_cia_aerea)."
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
					$w_ciaAereaSigla = $this->rscia[0][2];
				} else {
					$w_ciaAereaSigla = "ERR";				
				}						
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($w_origem)."
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_origemSigla = $this->rsaerop[0][1]; 
				} else {
					$w_origemSigla = "ERR";				
				}	
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($w_destino)."
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_destinoSigla = $this->rsaerop[0][1]; 
				} else {
					$w_destinoSigla = "ERR";				
				}	
				if ($w_publico <> '0') {
					$sqlPub = "			
					SELECT
						publico_id,
						publico_nome
					FROM
						publico_rsvp
					WHERE
						publico_id = ".$this->Db->qstr($w_publico)."
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
						$w_publicoDsc = $this->rspub[0][1];
					} else {
						$w_publicoDsc = "";				
					}
				} else {
					$w_publicoDsc = "";		
				}
				if ($w_regional <> '0') {
					$sqlReg = "								
					SELECT
						regional_id,
						regional_dsc
					FROM
						tbl_regionais
					WHERE
						regional_id = ".$this->Db->qstr($w_regional)."
					ORDER BY
						regional_id
					";
					 
      $nm_select = $sqlReg; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsreg = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsreg[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsreg = false;
          $this->rsreg_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsreg[0][0])) {									
						$w_regionalDsc = $this->rsreg[0][1];
					} else {
						$w_regionalDsc = "";				
					}
				} else {
					$w_regionalDsc = "";
				}
				if ($w_hotel <> '0') {
					$sqlHot = "								
					SELECT
						hotel_id,
						hotel_fantasia
					FROM
						tbl_hoteis
					WHERE
						hotel_id = ".$this->Db->qstr($w_hotel)."
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
						$w_hotelDsc = $this->rshot[0][1];
					} else {
						$w_hotelDsc = "";				
					}	
				} else {
					$w_hotelDsc = "";	
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
				switch($w_tipo_transfer) {
					case 'A':
						$w_tipo_transfer = 'AEREO';  		  
						break;
					case 'L':
						$w_tipo_transfer = 'LOCAL'; 
						break;
					case 'P':
						$w_tipo_transfer = 'PROPRIO'; 
						break;									
				}
				switch($w_status) {
					case 'A':
						$w_status = 'ABERTO';  		 
						break;
					case 'Y':
						$w_status = 'SIM'; 
						break;
					case 'N':
						$w_status = 'NAO'; 
						break;		
					case 'P':
						$w_status = 'PENDENTE'; 
						break;		
				}
				$sqlEve = "								
				SELECT
					evento_id,
					evento_nome				
				FROM
					eventos_rsvp
				WHERE
					evento_id = ".$this->Db->qstr($w_id_evento)."
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
				if ($vp_tipoPessoa == 'A') {										  
					$sqlPes = "								
					SELECT						
						pessoa_cpf,
						pessoa_nome				
					FROM
						pessoas_rsvp
					WHERE
						pessoa_cpf = ".$this->Db->qstr($w_cpf)."
					ORDER BY
						pessoa_cpf
					";		
					 
      $nm_select = $sqlPes; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspes = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspes[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspes = false;
          $this->rspes_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rspes[0][0])) {									
						$w_participante = $this->rspes[0][1];
					} else {
						$w_participante = "ERRO";				
					}							
				}	
				$sqlins = "
					SELECT 
						COUNT(cpf) as qtde
					FROM 
						trinaer_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($w_cpf)." 
					AND 
						id_evento = ".$this->Db->qstr($w_id_evento)."									
					AND
						localizador = ".$this->Db->qstr($w_localizador)." 
					AND
						num_voo	= ".$this->Db->qstr($w_num_voo)." 
					AND
						id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				";
				 
      $nm_select = $sqlins; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rslins = false;
          $this->rslins_erro = $this->Db->ErrorMsg();
      } 

				if (isset($this->rslins[0][0])) {
					$qtde = $this->rslins[0][0];
				} else {
					$qtde = 0;
				}
				if ($qtde == 0) {									
					$sqli = "	
					INSERT INTO   
						trinaer_rsvp_r
						(id_evento,		      
						data_saida,		     
						hora_saida,		     
						data_chegada,	     
						hora_chegada,	     
						cia_aerea,		       
						num_voo,			       
						origem,			           
						destino,			          
						participante,	     	
						publico,			          
						regional,		          
						hotel,			              
						grupo_dsc,		      
						departamento_dsc,    
						cargo_dsc,		      
						empresa_dsc,		    
						e_mail,			        
						ddd_celular,		    
						celular,			       
						ddd_01,			        
						fone_01,			       
						localizador,		    
						eticket,			       
						rg,				           
						cpf,				          
						data_nascimento,     
						observacoes,		    
						tipo_transfer,	     
						tipo_pessoa,		    
						status,			        
						cod_bloqueio,	     
						ativo,			         
						id_usuario_relato,
						comprado_belvitur,
						nota_gate,
						data_nota_gate,
						cia_aerea_sigla,
						direcao,
						origem_sigla,
						destino_sigla,
						publico_dsc,
						regional_dsc,
						hotel_dsc,
						usuario_relato_dsc,
						evento_dsc)
					VALUES
						(".$this->Db->qstr($w_id_evento).",    
						".$this->Db->qstr($w_data_saida).",   
						".$this->Db->qstr($w_hora_saida).",   
						".$this->Db->qstr($w_data_chegada).", 
						".$this->Db->qstr($w_hora_chegada).", 
						".$this->Db->qstr($w_cia_aerea).", 	 
						".$this->Db->qstr($w_num_voo).",      
						".$this->Db->qstr($w_origem).", 		 
						".$this->Db->qstr($w_destino).",		 
						".$this->Db->qstr($w_participante).",
						".$this->Db->qstr($w_publico).",		 
						".$this->Db->qstr($w_regional).",	 
						".$this->Db->qstr($w_hotel).",		 
						".$this->Db->qstr($w_grupo_dsc).",    
						".$this->Db->qstr($w_depto_dsc).",    
						".$this->Db->qstr($w_cargo_dsc).",    
						".$this->Db->qstr($w_empresa_dsc).",  
						".$this->Db->qstr($w_e_mail).",       
						".$this->Db->qstr($w_ddd_celular).",  
						".$this->Db->qstr($w_celular).",      
						".$this->Db->qstr($w_ddd_01).",       
						".$this->Db->qstr($w_fone_01).",      
						".$this->Db->qstr($w_localizador).",  
						".$this->Db->qstr($w_eticket).",      
						".$this->Db->qstr($w_rg).",           
						".$this->Db->qstr($w_cpf).",          
						".$this->Db->qstr($w_dtnasc).",       
						".$this->Db->qstr($w_observacoes).",  
						".$this->Db->qstr($w_tipo_transfer).",
						".$this->Db->qstr($w_tipo_pessoa).",  
						".$this->Db->qstr($w_status).",       
						".$this->Db->qstr($w_cod_bloqueio).", 
						".$this->Db->qstr($w_ativo).",
						".$this->Db->qstr($vp_usuario).",
						".$this->Db->qstr($w_emitidaBvt).",
						".$this->Db->qstr($w_notaGate).",
						".$this->Db->qstr($w_dtNotagate).",
						".$this->Db->qstr($w_ciaAereaSigla).",
						".$this->Db->qstr($w_direcao).",
						".$this->Db->qstr($w_origemSigla).",
						".$this->Db->qstr($w_destinoSigla).",
						".$this->Db->qstr($w_publicoDsc).", 
						".$this->Db->qstr($w_regionalDsc).", 
						".$this->Db->qstr($w_hotelDsc).", 
						".$this->Db->qstr($w_usurelDsc).",
						".$this->Db->qstr($w_eventoDsc).") 
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
      
				}	
				$ret = 'ADICIONA OK';
			}
		} else {
			if ($_passa_part == false) {
				$ret = 'ADICIONA ERRO';
			} else {
				$ret = 'ADICIONA OK';
			}	
		}		
		return $ret;
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}

}

?>
