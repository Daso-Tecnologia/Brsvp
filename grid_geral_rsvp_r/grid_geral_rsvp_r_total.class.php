<?php

class grid_geral_rsvp_r_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->evento_id = (isset($Busca_temp['evento_id'])) ? $Busca_temp['evento_id'] : ""; 
          $tmp_pos = (is_string($this->evento_id)) ? strpos($this->evento_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_id))
          {
              $this->evento_id = substr($this->evento_id, 0, $tmp_pos);
          }
          $this->evento_dsc = (isset($Busca_temp['evento_dsc'])) ? $Busca_temp['evento_dsc'] : ""; 
          $tmp_pos = (is_string($this->evento_dsc)) ? strpos($this->evento_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_dsc))
          {
              $this->evento_dsc = substr($this->evento_dsc, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->nome_participante = (isset($Busca_temp['nome_participante'])) ? $Busca_temp['nome_participante'] : ""; 
          $tmp_pos = (is_string($this->nome_participante)) ? strpos($this->nome_participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nome_participante))
          {
              $this->nome_participante = substr($this->nome_participante, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->checkin = (isset($Busca_temp['checkin'])) ? $Busca_temp['checkin'] : ""; 
          $tmp_pos = (is_string($this->checkin)) ? strpos($this->checkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->checkin))
          {
              $this->checkin = substr($this->checkin, 0, $tmp_pos);
          }
          $checkin_2 = (isset($Busca_temp['checkin_input_2'])) ? $Busca_temp['checkin_input_2'] : ""; 
          $this->checkin_2 = $checkin_2; 
          $this->checkout = (isset($Busca_temp['checkout'])) ? $Busca_temp['checkout'] : ""; 
          $tmp_pos = (is_string($this->checkout)) ? strpos($this->checkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->checkout))
          {
              $this->checkout = substr($this->checkout, 0, $tmp_pos);
          }
          $checkout_2 = (isset($Busca_temp['checkout_input_2'])) ? $Busca_temp['checkout_input_2'] : ""; 
          $this->checkout_2 = $checkout_2; 
          $this->hotel = (isset($Busca_temp['hotel'])) ? $Busca_temp['hotel'] : ""; 
          $tmp_pos = (is_string($this->hotel)) ? strpos($this->hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel))
          {
              $this->hotel = substr($this->hotel, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->comprado_bvt = (isset($Busca_temp['comprado_bvt'])) ? $Busca_temp['comprado_bvt'] : ""; 
          $tmp_pos = (is_string($this->comprado_bvt)) ? strpos($this->comprado_bvt, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->comprado_bvt))
          {
              $this->comprado_bvt = substr($this->comprado_bvt, 0, $tmp_pos);
          }
          $this->publico = (isset($Busca_temp['publico'])) ? $Busca_temp['publico'] : ""; 
          $tmp_pos = (is_string($this->publico)) ? strpos($this->publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico))
          {
              $this->publico = substr($this->publico, 0, $tmp_pos);
          }
          $this->publico_dsc = (isset($Busca_temp['publico_dsc'])) ? $Busca_temp['publico_dsc'] : ""; 
          $tmp_pos = (is_string($this->publico_dsc)) ? strpos($this->publico_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_dsc))
          {
              $this->publico_dsc = substr($this->publico_dsc, 0, $tmp_pos);
          }
          $this->regional = (isset($Busca_temp['regional'])) ? $Busca_temp['regional'] : ""; 
          $tmp_pos = (is_string($this->regional)) ? strpos($this->regional, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional))
          {
              $this->regional = substr($this->regional, 0, $tmp_pos);
          }
          $this->regional_dsc = (isset($Busca_temp['regional_dsc'])) ? $Busca_temp['regional_dsc'] : ""; 
          $tmp_pos = (is_string($this->regional_dsc)) ? strpos($this->regional_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional_dsc))
          {
              $this->regional_dsc = substr($this->regional_dsc, 0, $tmp_pos);
          }
          $this->cidade = (isset($Busca_temp['cidade'])) ? $Busca_temp['cidade'] : ""; 
          $tmp_pos = (is_string($this->cidade)) ? strpos($this->cidade, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cidade))
          {
              $this->cidade = substr($this->cidade, 0, $tmp_pos);
          }
          $this->presenca = (isset($Busca_temp['presenca'])) ? $Busca_temp['presenca'] : ""; 
          $tmp_pos = (is_string($this->presenca)) ? strpos($this->presenca, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca))
          {
              $this->presenca = substr($this->presenca, 0, $tmp_pos);
          }
          $this->contato = (isset($Busca_temp['contato'])) ? $Busca_temp['contato'] : ""; 
          $tmp_pos = (is_string($this->contato)) ? strpos($this->contato, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->contato))
          {
              $this->contato = substr($this->contato, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $regional;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral'] = "OK";
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function PrepGeral($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  	 
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';	
		$_trecho_ida = 'IDA';
		$_trecho_volta = 'VOLTA';		                                                                                        
		$w_aerstatus_volta	= '';
		$w_aerstatus_ida = '';
		$valor_y = 'Y';
	
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
			geral_rsvp_r
			WHERE                                                                                                            
				evento_id = ".$this->Db->qstr($vp_evento)."                                                                                     
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
                                                                                       
			
		}	
		if ($vp_tipoPessoa == 'P') {  
			if($vp_nivel <> 'CONVIDADO') {
				$sqlMestre = "
				SELECT
					participantes_rsvp.part_cpf, 				               	                            	       
					participantes_rsvp.nome_pessoa,                         
					participantes_rsvp.part_id_evento,	                         
					participantes_rsvp.part_nome_cracha,                            
					participantes_rsvp.part_tam_camisa,                  
					participantes_rsvp.part_tam_calcado,                 
					participantes_rsvp.part_cargo,                       
					participantes_rsvp.part_empresa,                     
					participantes_rsvp.part_departamento,                   
					participantes_rsvp.part_grupo,                          
					participantes_rsvp.part_id_evento_publico,              
					participantes_rsvp.part_id_evento_regional,             
					participantes_rsvp.part_dt_cadastro,                    
					participantes_rsvp.part_logradouro,                     
					participantes_rsvp.part_complemento,                    
					participantes_rsvp.part_bairro,                         
					participantes_rsvp.part_cidade,                         
					participantes_rsvp.part_cep,                            
					participantes_rsvp.part_uf,	                              
					participantes_rsvp.part_pais,                           
					participantes_rsvp.part_ddd_01,                         
					participantes_rsvp.part_fone_01,                        
					participantes_rsvp.part_ddd_celular_01,                 
					participantes_rsvp.part_celeular_01,                    
					participantes_rsvp.part_passaporte,                     
					participantes_rsvp.part_validade_pass,                  
					participantes_rsvp.part_rg,                             
					participantes_rsvp.part_filiacao,                       
					participantes_rsvp.part_dt_nasc,                        
					participantes_rsvp.part_fumante,                        
					participantes_rsvp.part_restricao_alimentar,            
					participantes_rsvp.part_email,                          
					participantes_rsvp.part_dt_alt_presenca,                
					participantes_rsvp.part_presenca,                       
					participantes_rsvp.part_contato_rsvp,                   
					participantes_rsvp.part_nome_substituto, 				 				
					hospedagem_rsvp.hosp_cpf_participante,                      
					hospedagem_rsvp.hosp_id_evento,                             
					hospedagem_rsvp.hosp_acompanhante,                          
					hospedagem_rsvp.hosp_part_acomp,                            
					hospedagem_rsvp.hosp_dt_checkin,                            
					hospedagem_rsvp.hosp_dt_checkout,                           
					hospedagem_rsvp.hosp_id_hotel,                              
					hospedagem_rsvp.hosp_reserva_bvt,                           				                          
					transfer_rsvp.tra_id_evento,                                   
					transfer_rsvp.tra_cpf_particip,                                
					transfer_rsvp.tra_dt_saida_ida,                                
					transfer_rsvp.tra_hr_saida_ida,                                
					transfer_rsvp.tra_dt_chegada_ida,                              
					transfer_rsvp.tra_hr_chegada_ida,                              
					transfer_rsvp.tra_cia_ida,                                     
					transfer_rsvp.tra_origem_ida,                                  
					transfer_rsvp.tra_destino_ida,                                 
					transfer_rsvp.tra_numvoo_ida,                                  
					transfer_rsvp.tra_localizador_ida,                             
					transfer_rsvp.tra_eticket_ida,                                 
					transfer_rsvp.tra_hrtransout,                                  
					transfer_rsvp.tra_dt_ida_local,                                
					transfer_rsvp.tra_hr_ida_local,                                
					transfer_rsvp.tra_dt_volta_local,                              
					transfer_rsvp.tra_hr_volta_local,                              
					transfer_rsvp.tra_cia_volta,                                
					transfer_rsvp.tra_origem_volta,                             
					transfer_rsvp.tra_destino_volta,                            
					transfer_rsvp.tra_numvoo_volta,                             
					transfer_rsvp.tra_localizador_volta,                        
					transfer_rsvp.tra_eticket_volta,                            
					transfer_rsvp.tra_observacao,               
					transfer_rsvp.tra_tipo,                            
					hospedagem_rsvp.hosp_early_chkin,  		           
					hospedagem_rsvp.hosp_late_chkout,                    
					transfer_rsvp.tra_status,  					 
					transfer_rsvp.tra_id_hotel_out,				
					transfer_rsvp.tra_dt_saida_volta,			
					transfer_rsvp.tra_hr_saida_volta, 					
					transfer_rsvp.tra_dt_chegada_volta,			
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					participantes_rsvp.part_cod_substituto,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional
				FROM                                            		             
					participantes_rsvp                                             
				LEFT JOIN
					hospedagem_rsvp
				ON
					participantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					participantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					participantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					participantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento					
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento		
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)."                
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."                   		
				AND 	
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 	
				GROUP BY
					participantes_rsvp.part_cpf		
				ORDER BY
					participantes_rsvp.nome_pessoa 	
				";	
			} else {
				$sqlMestre = "
				SELECT
					participantes_rsvp.part_cpf, 				               	                            	       
					participantes_rsvp.nome_pessoa,                         
					participantes_rsvp.part_id_evento,	                         
					participantes_rsvp.part_nome_cracha,                            
					participantes_rsvp.part_tam_camisa,                  
					participantes_rsvp.part_tam_calcado,                 
					participantes_rsvp.part_cargo,                       
					participantes_rsvp.part_empresa,                     
					participantes_rsvp.part_departamento,                   
					participantes_rsvp.part_grupo,                          
					participantes_rsvp.part_id_evento_publico,              
					participantes_rsvp.part_id_evento_regional,             
					participantes_rsvp.part_dt_cadastro,                    
					participantes_rsvp.part_logradouro,                     
					participantes_rsvp.part_complemento,                    
					participantes_rsvp.part_bairro,                         
					participantes_rsvp.part_cidade,                         
					participantes_rsvp.part_cep,                            
					participantes_rsvp.part_uf,	                              
					participantes_rsvp.part_pais,                           
					participantes_rsvp.part_ddd_01,                         
					participantes_rsvp.part_fone_01,                        
					participantes_rsvp.part_ddd_celular_01,                 
					participantes_rsvp.part_celeular_01,                    
					participantes_rsvp.part_passaporte,                     
					participantes_rsvp.part_validade_pass,                  
					participantes_rsvp.part_rg,                             
					participantes_rsvp.part_filiacao,                       
					participantes_rsvp.part_dt_nasc,                        
					participantes_rsvp.part_fumante,                        
					participantes_rsvp.part_restricao_alimentar,            
					participantes_rsvp.part_email,                          
					participantes_rsvp.part_dt_alt_presenca,                
					participantes_rsvp.part_presenca,                       
					participantes_rsvp.part_contato_rsvp,                   
					participantes_rsvp.part_nome_substituto, 				 				
					hospedagem_rsvp.hosp_cpf_participante,                      
					hospedagem_rsvp.hosp_id_evento,                             
					hospedagem_rsvp.hosp_acompanhante,                          
					hospedagem_rsvp.hosp_part_acomp,                            
					hospedagem_rsvp.hosp_dt_checkin,                            
					hospedagem_rsvp.hosp_dt_checkout,                           
					hospedagem_rsvp.hosp_id_hotel,                              
					hospedagem_rsvp.hosp_reserva_bvt,                           				                          
					transfer_rsvp.tra_id_evento,                                   
					transfer_rsvp.tra_cpf_particip,                                
					transfer_rsvp.tra_dt_saida_ida,                                
					transfer_rsvp.tra_hr_saida_ida,                                
					transfer_rsvp.tra_dt_chegada_ida,                              
					transfer_rsvp.tra_hr_chegada_ida,                              
					transfer_rsvp.tra_cia_ida,                                     
					transfer_rsvp.tra_origem_ida,                                  
					transfer_rsvp.tra_destino_ida,                                 
					transfer_rsvp.tra_numvoo_ida,                                  
					transfer_rsvp.tra_localizador_ida,                             
					transfer_rsvp.tra_eticket_ida,                                 
					transfer_rsvp.tra_hrtransout,                                  
					transfer_rsvp.tra_dt_ida_local,                                
					transfer_rsvp.tra_hr_ida_local,                                
					transfer_rsvp.tra_dt_volta_local,                              
					transfer_rsvp.tra_hr_volta_local,                              
					transfer_rsvp.tra_cia_volta,                                
					transfer_rsvp.tra_origem_volta,                             
					transfer_rsvp.tra_destino_volta,                            
					transfer_rsvp.tra_numvoo_volta,                             
					transfer_rsvp.tra_localizador_volta,                        
					transfer_rsvp.tra_eticket_volta,                            
					transfer_rsvp.tra_observacao,               
					transfer_rsvp.tra_tipo,                            
					hospedagem_rsvp.hosp_early_chkin,  		           
					hospedagem_rsvp.hosp_late_chkout,                    
					transfer_rsvp.tra_status,  					 
					transfer_rsvp.tra_id_hotel_out,				
					transfer_rsvp.tra_dt_saida_volta,			
					transfer_rsvp.tra_hr_saida_volta, 					
					transfer_rsvp.tra_dt_chegada_volta,			
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					participantes_rsvp.part_cod_substituto,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional,
					participantes_rsvp.dsc_empresa_rsvp
				FROM                                            		             
					participantes_rsvp                                             
				LEFT JOIN
					hospedagem_rsvp
				ON
					participantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					participantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					participantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					participantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento					
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento		
				WHERE
					part_id_evento =  ".$this->Db->qstr($vp_evento)."  
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
				AND 	
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)." 
				GROUP BY
					participantes_rsvp.part_cpf		
				ORDER BY
					participantes_rsvp.nome_pessoa 	
				";					
			}
			$_passa_part = true;	
			
			
			
		} else {
			if($vp_nivel <> 'CONVIDADO') {
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_cpf, 					
					acompanhantes_rsvp.part_nome, 
					acompanhantes_rsvp.part_id_evento,	
					acompanhantes_rsvp.part_nome_cracha, 	 
					acompanhantes_rsvp.part_tam_camisa, 
					acompanhantes_rsvp.part_tam_calcado,
					acompanhantes_rsvp.part_cargo,
					acompanhantes_rsvp.part_empresa,
					acompanhantes_rsvp.part_departamento,
					acompanhantes_rsvp.part_grupo,
					acompanhantes_rsvp.part_id_evento_publico, 
					acompanhantes_rsvp.part_id_evento_regional, 
					acompanhantes_rsvp.part_dt_cadastro, 
					acompanhantes_rsvp.part_logradouro,
					acompanhantes_rsvp.part_complemento, 
					acompanhantes_rsvp.part_bairro,
					acompanhantes_rsvp.part_cidade,
					acompanhantes_rsvp.part_cep,
					acompanhantes_rsvp.part_uf,	
					acompanhantes_rsvp.part_pais,
					acompanhantes_rsvp.part_ddd_01, 
					acompanhantes_rsvp.part_fone_01, 
					acompanhantes_rsvp.part_ddd_celular_01, 
					acompanhantes_rsvp.part_celeular_01, 
					acompanhantes_rsvp.part_passaporte,
					acompanhantes_rsvp.part_validade_pass,
					acompanhantes_rsvp.part_rg,
					acompanhantes_rsvp.part_filiacao,
					acompanhantes_rsvp.part_dt_nasc, 
					acompanhantes_rsvp.part_fumante,
					acompanhantes_rsvp.part_restricao_alimentar,
					acompanhantes_rsvp.part_email,
					acompanhantes_rsvp.part_dt_alt_presenca,
					acompanhantes_rsvp.part_presenca,
					acompanhantes_rsvp.part_contato_rsvp,
					acompanhantes_rsvp.part_cpf_mestre,				
					hospedagem_rsvp.hosp_cpf_participante,
					hospedagem_rsvp.hosp_id_evento,
					hospedagem_rsvp.hosp_acompanhante,
					hospedagem_rsvp.hosp_part_acomp,
					hospedagem_rsvp.hosp_dt_checkin, 
					hospedagem_rsvp.hosp_dt_checkout,
					hospedagem_rsvp.hosp_id_hotel, 
					hospedagem_rsvp.hosp_reserva_bvt,
					transfer_rsvp.tra_id_evento,
					transfer_rsvp.tra_cpf_particip,
					transfer_rsvp.tra_dt_saida_ida,
					transfer_rsvp.tra_hr_saida_ida,
					transfer_rsvp.tra_dt_chegada_ida,
					transfer_rsvp.tra_hr_chegada_ida,
					transfer_rsvp.tra_cia_ida, 
					transfer_rsvp.tra_origem_ida, 
					transfer_rsvp.tra_destino_ida, 
					transfer_rsvp.tra_numvoo_ida, 
					transfer_rsvp.tra_localizador_ida,
					transfer_rsvp.tra_eticket_ida, 
					transfer_rsvp.tra_hrtransout,
					transfer_rsvp.tra_dt_ida_local,
					transfer_rsvp.tra_hr_ida_local,
					transfer_rsvp.tra_dt_volta_local,
					transfer_rsvp.tra_hr_volta_local,
					transfer_rsvp.tra_cia_volta,
					transfer_rsvp.tra_origem_volta,
					transfer_rsvp.tra_destino_volta,
					transfer_rsvp.tra_numvoo_volta,
					transfer_rsvp.tra_localizador_volta,
					transfer_rsvp.tra_eticket_volta,
					transfer_rsvp.tra_observacao,
					transfer_rsvp.tra_tipo,
					hospedagem_rsvp.hosp_early_chkin,  		
					hospedagem_rsvp.hosp_late_chkout,
					transfer_rsvp.tra_status,
					transfer_rsvp.tra_id_hotel_out,
					transfer_rsvp.tra_dt_saida_volta,	
					transfer_rsvp.tra_hr_saida_volta, 	
					transfer_rsvp.tra_dt_chegada_volta,	
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					acompanhantes_rsvp.part_fone_internacional					
				FROM 
					acompanhantes_rsvp
				LEFT JOIN
					hospedagem_rsvp
				ON
					acompanhantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					acompanhantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					acompanhantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					acompanhantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento	
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)." 	
				AND
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."	
				
				GROUP BY
					acompanhantes_rsvp.part_cpf		
				ORDER BY
					acompanhantes_rsvp.part_nome
				";	
			} else {
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_cpf, 					
					acompanhantes_rsvp.part_nome, 
					acompanhantes_rsvp.part_id_evento,	
					acompanhantes_rsvp.part_nome_cracha, 	 
					acompanhantes_rsvp.part_tam_camisa, 
					acompanhantes_rsvp.part_tam_calcado,
					acompanhantes_rsvp.part_cargo,
					acompanhantes_rsvp.part_empresa,
					acompanhantes_rsvp.part_departamento,
					acompanhantes_rsvp.part_grupo,
					acompanhantes_rsvp.part_id_evento_publico, 
					acompanhantes_rsvp.part_id_evento_regional, 
					acompanhantes_rsvp.part_dt_cadastro, 
					acompanhantes_rsvp.part_logradouro,
					acompanhantes_rsvp.part_complemento, 
					acompanhantes_rsvp.part_bairro,
					acompanhantes_rsvp.part_cidade,
					acompanhantes_rsvp.part_cep,
					acompanhantes_rsvp.part_uf,	
					acompanhantes_rsvp.part_pais,
					acompanhantes_rsvp.part_ddd_01, 
					acompanhantes_rsvp.part_fone_01, 
					acompanhantes_rsvp.part_ddd_celular_01, 
					acompanhantes_rsvp.part_celeular_01, 
					acompanhantes_rsvp.part_passaporte,
					acompanhantes_rsvp.part_validade_pass,
					acompanhantes_rsvp.part_rg,
					acompanhantes_rsvp.part_filiacao,
					acompanhantes_rsvp.part_dt_nasc, 
					acompanhantes_rsvp.part_fumante,
					acompanhantes_rsvp.part_restricao_alimentar,
					acompanhantes_rsvp.part_email,
					acompanhantes_rsvp.part_dt_alt_presenca,
					acompanhantes_rsvp.part_presenca,
					acompanhantes_rsvp.part_contato_rsvp,
					acompanhantes_rsvp.part_cpf_mestre,				
					hospedagem_rsvp.hosp_cpf_participante,
					hospedagem_rsvp.hosp_id_evento,
					hospedagem_rsvp.hosp_acompanhante,
					hospedagem_rsvp.hosp_part_acomp,
					hospedagem_rsvp.hosp_dt_checkin, 
					hospedagem_rsvp.hosp_dt_checkout,
					hospedagem_rsvp.hosp_id_hotel, 
					hospedagem_rsvp.hosp_reserva_bvt,
					transfer_rsvp.tra_id_evento,
					transfer_rsvp.tra_cpf_particip,
					transfer_rsvp.tra_dt_saida_ida,
					transfer_rsvp.tra_hr_saida_ida,
					transfer_rsvp.tra_dt_chegada_ida,
					transfer_rsvp.tra_hr_chegada_ida,
					transfer_rsvp.tra_cia_ida, 
					transfer_rsvp.tra_origem_ida, 
					transfer_rsvp.tra_destino_ida, 
					transfer_rsvp.tra_numvoo_ida, 
					transfer_rsvp.tra_localizador_ida,
					transfer_rsvp.tra_eticket_ida, 
					transfer_rsvp.tra_hrtransout,
					transfer_rsvp.tra_dt_ida_local,
					transfer_rsvp.tra_hr_ida_local,
					transfer_rsvp.tra_dt_volta_local,
					transfer_rsvp.tra_hr_volta_local,
					transfer_rsvp.tra_cia_volta,
					transfer_rsvp.tra_origem_volta,
					transfer_rsvp.tra_destino_volta,
					transfer_rsvp.tra_numvoo_volta,
					transfer_rsvp.tra_localizador_volta,
					transfer_rsvp.tra_eticket_volta,
					transfer_rsvp.tra_observacao,
					transfer_rsvp.tra_tipo,
					hospedagem_rsvp.hosp_early_chkin,  		
					hospedagem_rsvp.hosp_late_chkout,
					transfer_rsvp.tra_status,
					transfer_rsvp.tra_id_hotel_out,
					transfer_rsvp.tra_dt_saida_volta,	
					transfer_rsvp.tra_hr_saida_volta, 	
					transfer_rsvp.tra_dt_chegada_volta,	
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					acompanhantes_rsvp.part_fone_internacional,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM 
					acompanhantes_rsvp
				LEFT JOIN
					hospedagem_rsvp
				ON
					acompanhantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					acompanhantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					acompanhantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					acompanhantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento	
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)."  	
				AND
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP BY
					acompanhantes_rsvp.part_cpf		
				ORDER BY
					acompanhantes_rsvp.part_nome
				";	
			}
			$_passa_part = true;	
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
					$_ap_cpf					= $this->rsm[$i][0]; 		 
					$_ap_nome               	= $this->rsm[$i][1];        
					$_ap_id_evento	       		= $this->rsm[$i][2];        
					$_ap_nome_cracha 	   		= $this->rsm[$i][3];        
					$_ap_tam_camisa             = $this->rsm[$i][4];        
					$_ap_tam_calcado            = $this->rsm[$i][5];        
					$_ap_cargo                  = $this->rsm[$i][6];        
					$_ap_empresa                = $this->rsm[$i][7];        
					$_ap_departamento       	= $this->rsm[$i][8];        
					$_ap_grupo              	= $this->rsm[$i][9];        
					$_ap_id_evento_publico  	= $this->rsm[$i][10];       
					$_ap_id_evento_regional 	= $this->rsm[$i][11];       
					$_ap_dt_cadastro        	= $this->rsm[$i][12];       
					$_ap_logradouro         	= $this->rsm[$i][13];       
					$_ap_complemento        	= $this->rsm[$i][14];       
					$_ap_bairro             	= $this->rsm[$i][15];       
					$_ap_cidade             	= $this->rsm[$i][16];       
					$_ap_cep                	= $this->rsm[$i][17];       
					$_ap_uf	                	= $this->rsm[$i][18];       
					$_ap_pais               	= $this->rsm[$i][19];       
					$_ap_ddd_01             	= $this->rsm[$i][20];       
					$_ap_fone_01            	= $this->rsm[$i][21];       
					$_ap_ddd_celular_01     	= $this->rsm[$i][22];       
					$_ap_celeular_01        	= $this->rsm[$i][23];       
					$_ap_passaporte         	= $this->rsm[$i][24];       
					$_ap_validade_pass      	= $this->rsm[$i][25];       
					$_ap_rg                 	= $this->rsm[$i][26];       
					$_ap_filiacao           	= $this->rsm[$i][27];       
					$_ap_dt_nasc            	= $this->rsm[$i][28];       
					$_ap_fumante            	= $this->rsm[$i][29];       
					$_ap_restricao_alimentar	= $this->rsm[$i][30];	    
					$_ap_email              	= $this->rsm[$i][31];       
					$_ap_dt_alt_presenca    	= $this->rsm[$i][32];       
					$_ap_presenca           	= $this->rsm[$i][33];       
					$_ap_contato_rsvp       	= $this->rsm[$i][34];			
					$_ap_nome_substituto 		= $this->rsm[$i][35];			
					$_ho_cpf_participante   	= $this->rsm[$i][36];       
					$_ho_id_evento          	= $this->rsm[$i][37];       
					$_ho_acompanhante       	= $this->rsm[$i][38];       
					$_ho_part_acomp         	= $this->rsm[$i][39];       
					$_ho_dt_checkin         	= $this->rsm[$i][40];       
					$_ho_dt_checkout        	= $this->rsm[$i][41];       
					$_ho_id_hotel           	= $this->rsm[$i][42];       
					$_ho_reserva_bvt        	= $this->rsm[$i][43];       
					$_tr_id_evento          	= $this->rsm[$i][44];       
					$_tr_cpf_particip       	= $this->rsm[$i][45];       
					$_tr_dt_saida_ida       	= $this->rsm[$i][46];       
					$_tr_hr_saida_ida       	= $this->rsm[$i][47];       
					$_tr_dt_chegada_ida     	= $this->rsm[$i][48];       
					$_tr_hr_chegada_ida     	= $this->rsm[$i][49];       
					$_tr_cia_ida            	= $this->rsm[$i][50];       
					$_tr_origem_ida         	= $this->rsm[$i][51];       
					$_tr_destino_ida        	= $this->rsm[$i][52];       
					$_tr_numvoo_ida         	= $this->rsm[$i][53];       
					$_tr_localizador_ida    	= $this->rsm[$i][54];       
					$_tr_eticket_ida        	= $this->rsm[$i][55];       
					$_tr_hrtransout         	= $this->rsm[$i][56];       
					$_tr_dt_ida_local       	= $this->rsm[$i][57];       
					$_tr_hr_ida_local       	= $this->rsm[$i][58];       
					$_tr_dt_volta_local     	= $this->rsm[$i][59];       
					$_tr_hr_volta_local     	= $this->rsm[$i][60];       
					$_tr_cia_volta              = $this->rsm[$i][61];       
					$_tr_origem_volta           = $this->rsm[$i][62];       
					$_tr_destino_volta          = $this->rsm[$i][63];       
					$_tr_numvoo_volta           = $this->rsm[$i][64];       
					$_tr_localizador_volta      = $this->rsm[$i][65];       
					$_tr_eticket_volta          = $this->rsm[$i][66];       
					$_tr_observacao	            = $this->rsm[$i][67];       
					$_tr_tipo_transfer			= $this->rsm[$i][68];    					   
					$_ho_early_chkin  			= $this->rsm[$i][69];    					   
					$_ho_late_chkout			= $this->rsm[$i][70]; 
					$_tr_status       			= $this->rsm[$i][71];
					$_tr_id_hotel_out			= $this->rsm[$i][72]; 
					$_tr_dt_saida_volta			= $this->rsm[$i][73];
					$_tr_hr_saida_volta			= $this->rsm[$i][74];
					$_tr_dt_chegada_volta		= $this->rsm[$i][75];
					$_tr_hr_chegada_volta		= $this->rsm[$i][76];
					$_tr_dt_chegada_prop		= $this->rsm[$i][77];
					$_tr_hr_chegada_prop		= $this->rsm[$i][78];	
					$_ap_cod_substituto			= $this->rsm[$i][79];
					$_ho_hosp_diarias			= $this->rsm[$i][80]; 
					$_ho_hosp_taxas     		= $this->rsm[$i][81]; 
					$_an_anota_dsc				= $this->rsm[$i][82]; 
					$_ap_nome_acompanhado 		= '';		   
					$_ap_cpf_mestre				= '';
					$w_foneinter				= $this->rsm[$i][83];
				} else {
					$_ap_cpf 					= $this->rsm[$i][0];       
					$_ap_nome               	= $this->rsm[$i][1];    
					$_ap_id_evento	        	= $this->rsm[$i][2];    
					$_ap_nome_cracha 	    	= $this->rsm[$i][3];    
					$_ap_tam_camisa         	= $this->rsm[$i][4];    
					$_ap_tam_calcado        	= $this->rsm[$i][5];    
					$_ap_cargo              	= $this->rsm[$i][6];    
					$_ap_empresa            	= $this->rsm[$i][7];    
					$_ap_departamento       	= $this->rsm[$i][8];    
					$_ap_grupo              	= $this->rsm[$i][9];    
					$_ap_id_evento_publico  	= $this->rsm[$i][10];    
					$_ap_id_evento_regional 	= $this->rsm[$i][11];    
					$_ap_dt_cadastro        	= $this->rsm[$i][12];    
					$_ap_logradouro         	= $this->rsm[$i][13];    
					$_ap_complemento        	= $this->rsm[$i][14];    
					$_ap_bairro             	= $this->rsm[$i][15];    
					$_ap_cidade             	= $this->rsm[$i][16];    
					$_ap_cep                	= $this->rsm[$i][17];    
					$_ap_uf	                	= $this->rsm[$i][18];    
					$_ap_pais               	= $this->rsm[$i][19];    
					$_ap_ddd_01             	= $this->rsm[$i][20];    
					$_ap_fone_01            	= $this->rsm[$i][21];    
					$_ap_ddd_celular_01     	= $this->rsm[$i][22];    
					$_ap_celeular_01        	= $this->rsm[$i][23];    
					$_ap_passaporte         	= $this->rsm[$i][24];    
					$_ap_validade_pass      	= $this->rsm[$i][25];    
					$_ap_rg                 	= $this->rsm[$i][26];    
					$_ap_filiacao           	= $this->rsm[$i][27];    
					$_ap_dt_nasc            	= $this->rsm[$i][28];    
					$_ap_fumante            	= $this->rsm[$i][29];    
					$_ap_restricao_alimentar	= $this->rsm[$i][30];    
					$_ap_email              	= $this->rsm[$i][31];    
					$_ap_dt_alt_presenca    	= $this->rsm[$i][32];    
					$_ap_presenca           	= $this->rsm[$i][33];    
					$_ap_contato_rsvp       	= $this->rsm[$i][34];    			
					$_ap_cpf_mestre				= $this->rsm[$i][35];    
					$_ho_cpf_participante    	= $this->rsm[$i][36];    
					$_ho_id_evento           	= $this->rsm[$i][37];    
					$_ho_acompanhante        	= $this->rsm[$i][38];    
					$_ho_part_acomp          	= $this->rsm[$i][39];    
					$_ho_dt_checkin          	= $this->rsm[$i][40];    
					$_ho_dt_checkout         	= $this->rsm[$i][41];    
					$_ho_id_hotel            	= $this->rsm[$i][42];    
					$_ho_reserva_bvt         	= $this->rsm[$i][43];    
					$_tr_id_evento           	= $this->rsm[$i][44];    
					$_tr_cpf_particip        	= $this->rsm[$i][45];    
					$_tr_dt_saida_ida        	= $this->rsm[$i][46];    
					$_tr_hr_saida_ida        	= $this->rsm[$i][47];    
					$_tr_dt_chegada_ida      	= $this->rsm[$i][48];    
					$_tr_hr_chegada_ida      	= $this->rsm[$i][49];    
					$_tr_cia_ida             	= $this->rsm[$i][50];    
					$_tr_origem_ida          	= $this->rsm[$i][51];    
					$_tr_destino_ida         	= $this->rsm[$i][52];    
					$_tr_numvoo_ida          	= $this->rsm[$i][53];    
					$_tr_localizador_ida     	= $this->rsm[$i][54];    
					$_tr_eticket_ida         	= $this->rsm[$i][55];    
					$_tr_hrtransout          	= $this->rsm[$i][56];    
					$_tr_dt_ida_local        	= $this->rsm[$i][57];    
					$_tr_hr_ida_local        	= $this->rsm[$i][58];    
					$_tr_dt_volta_local      	= $this->rsm[$i][59];    
					$_tr_hr_volta_local      	= $this->rsm[$i][60];    
					$_tr_cia_volta           	= $this->rsm[$i][61];    
					$_tr_origem_volta        	= $this->rsm[$i][62];    
					$_tr_destino_volta       	= $this->rsm[$i][63];    
					$_tr_numvoo_volta        	= $this->rsm[$i][64];    
					$_tr_localizador_volta      = $this->rsm[$i][65];    
					$_tr_eticket_volta          = $this->rsm[$i][66];    
					$_tr_observacao	       		= $this->rsm[$i][67];	  
					$_tr_tipo_transfer			= $this->rsm[$i][68];       
					$_ho_early_chkin  			= $this->rsm[$i][69];    					   
					$_ho_late_chkout			= $this->rsm[$i][70];    					   
					$_tr_status       			= $this->rsm[$i][71];
					$_tr_id_hotel_out			= $this->rsm[$i][72]; 
					$_tr_dt_saida_volta			= $this->rsm[$i][73];
					$_tr_hr_saida_volta			= $this->rsm[$i][74];
					$_tr_dt_chegada_volta		= $this->rsm[$i][75];
					$_tr_hr_chegada_volta		= $this->rsm[$i][76];		   
					$_tr_dt_chegada_prop		= $this->rsm[$i][77];
					$_tr_hr_chegada_prop		= $this->rsm[$i][78];			
					$_ho_hosp_diarias			= $this->rsm[$i][79]; 
					$_ho_hosp_taxas     		= $this->rsm[$i][80]; 
					$_ap_nome_substituto		= '';
					$_ap_nome_acompanhado 		= '';			
					$_ap_cod_substituto			= '';
					$w_foneinter				= $this->rsm[$i][83];
				}	
				
				$foneok = is_null($w_foneinter);
				if($foneok == true) {
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
				switch($_tr_tipo_transfer) {                                                                                      
					case 'A':                                                                                                      
						$_tr_tipo_transfer = 'AEREO';  		                                                                               
						break;                                                                                                        
					case 'L':                                                                                                      
						$_tr_tipo_transfer	= 'LOCAL';                                                                                   
						break;                                                                                                        
					case 'P':                                                                                                      
						$_tr_tipo_transfer	= 'PROPRIO';                                                                                 
						break;	                                                                                                       
				}     
				switch($_tr_status) {
				case 'A':
					$_tr_status = 'ABERTO';  		 
					break;
				case 'Y':
					$_tr_status = 'SIM'; 
					break;
				case 'N':
					$_tr_status = 'NAO'; 
					break;		
				case 'P':
					$_tr_status = 'PENDENTE'; 
					break;		
				}			    				
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)." '                                                                                 
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
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($_tr_cia_ida)."                                                                                 
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
					cia_id = '".$_tr_cia_volta."'                                                                                 
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
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($_ap_id_evento_publico)."                                                                                 
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
					hotel_id = ".$this->Db->qstr($_ho_id_hotel)."                                                                                 
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
				if ($_ho_early_chkin  == 'Y') {
					$_ho_early_chkin  = 'SIM';
				} else {
					$_ho_early_chkin  = 'ABERTO';
				}
				if ($_ho_late_chkout == 'Y') {
					$_ho_late_chkout = 'SIM';
				} else {	
					$_ho_late_chkout = 'ABERTO';
				}	
				$sqlHotout = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id =  ".$this->Db->qstr($_tr_id_hotel_out)."                                                                                     
				ORDER BY                                                                                                        
					hotel_id
				";		                                                                                                            
				 
      $nm_select = $sqlHotout; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshotout = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshotout[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshotout = false;
          $this->rshotout_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshotout[0][0])) {									                                                                            
					$w_hotel_dsc_out = $this->rshotout[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc_out = "";				                                                                                         
				}											
				if ($vp_tipoPessoa == 'P') {
					$w_tipopess = 'PARTICIPANTE';
				} else {
					$w_tipopess = 'ACOMPANHANTE';
				}				
				$sqlReg = "								                                                                                             
				SELECT                                                                                                          
					regional_id,
					regional_dsc
				FROM                                                                                                            
					tbl_regionais
				WHERE                                                                                                           
					regional_id = ".$this->Db->qstr($_ap_id_evento_regional)."                                                                                  
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
					$w_regional = $this->rsreg[0][1];                                                                                  
				} else {                                                                                                        
					$w_regional = "";				                                                                                         
				}								
				$sqlPais = "								                                                                                             
				SELECT                                                                                                          
					pais_id,
					descricao
				FROM                                                                                                            
					tbl_paises
				WHERE                                                                                                           
					pais_id = ".$this->Db->qstr($_ap_pais)."                                                                                 
				ORDER BY                                                                                                        
					pais_id
				";		                                                                                                            
				 
      $nm_select = $sqlPais; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspais = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspais[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspais = false;
          $this->rspais_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspais[0][0])) {									                                                                            
					$w_pais = $this->rspais[0][1];                                                                                  
				} else {                                                                                                        
					$w_pais = "";				                                                                                         
				}				
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_origem_ida)." 
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
					$w_origemIda = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_origemIda = "";				
				}				
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_destino_ida)."  
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
					$w_destinoIda = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_destinoIda = "";				
				}													
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_origem_volta)."      
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
					$w_origemVolta = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_origemVolta = "";				
				}													
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_destino_volta)."    
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
					$w_destinoVolta = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_destinoVolta = "";				
				}				
				
				if ($_ap_nome_substituto <> '') {
					$_guardaNome = $_ap_nome;
					$_ap_nome = $_ap_nome_substituto;
				} else {
					$_guardaNome = '';
					$_ap_nome_substituto = '';
				}						
				if ($vp_tipoPessoa == 'A') {
					$sqlAmestre = "			
					SELECT
						part_cpf,
						nome_pessoa,
						part_id_evento					
					FROM
						participantes_rsvp	
					WHERE
						part_cpf = ".$this->Db->qstr($_ap_cpf_mestre)."     
					AND
						part_id_evento = ".$this->Db->qstr($vp_evento)."   
					ORDER BY
						part_cpf,part_id_evento					
					";
					 
      $nm_select = $sqlAmestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsamestre = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsamestre[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsamestre = false;
          $this->rsamestre_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsamestre[0][0])) {									
						$_ap_nome_acompanhado = $this->rsamestre[0][1];
					} else {
						$_ap_nome_acompanhado = '';
					}				
				}	
				$sqlHosp = "								                                                                                             
				SELECT            
					hosp_cpf_participante,                                                                                              
					hosp_id_evento,
					hosp_id_hotel,
					hosp_reserva_bvt
				FROM                                                                                                            
					hospedagem_rsvp
				WHERE
					hosp_cpf_participante = ".$this->Db->qstr($_ap_cpf)."  
				AND
					hosp_id_evento = ".$this->Db->qstr($_ap_id_evento)."    
				AND                                                                                                          
					hosp_id_hotel = ".$this->Db->qstr($_tr_id_hotel_out)."                                                                                   
				ORDER BY                                                                                                        
					hosp_cpf_participante,hosp_id_evento,hosp_id_hotel
				";		                                                                                                            
				 
      $nm_select = $sqlHosp; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshosp = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshosp[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshosp = false;
          $this->rshosp_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshosp[0][0])) {									                                                                            					
					if ($this->rshosp[0][3] == 'Y') {
						$w_comprada_bvt = 'SIM';
					} else{
						$w_comprada_bvt = 'NÃO';
					}	
				} else {                                                                                                        
					$w_comprada_bvt = "";				                                                                                         
				}											
				if ($vp_tipoPessoa == 'P') {
					$w_tipopess = 'PARTICIPANTE';
				} else {
					$w_tipopess = 'ACOMPANHANTE';
				}				
				if ($_ho_reserva_bvt == 'Y') {
					$_ho_reserva_bvt = 'SIM';	
				} else {
					$_ho_reserva_bvt = 'NÃO';	
				}
				if ($_ap_fumante == 'N') {
					$_ap_fumante = 'NÃO';
				} else {
					$_ap_fumante = 'SIM';
				}
				switch($_ap_presenca) {
				case 'A':
					$_ap_presenca = 'ABERTO';  		 
					break;
				case 'Y':
					$_ap_presenca = 'SIM'; 
					break;
				case 'N':
					$_ap_presenca = 'NAO'; 
					break;		
				case 'P':
					$_ap_presenca = 'PENDENTE'; 
					break;		
				}	
				switch($_ap_contato_rsvp) {
				case 'A':
					$_ap_contato_rsvp = 'ABERTO';  		 
					break;
				case 'Y':
					$_ap_contato_rsvp = 'SIM'; 
					break;
				case 'N':
					$_ap_contato_rsvp = 'NAO'; 
					break;		
				case 'P':
					$_ap_contato_rsvp = 'PENDENTE'; 
					break;		
				}
				if ($w_ciaida == "") {
					$w_aerstatus_ida = '';
					$sqltaer = "								                                                                                             
					SELECT                                                                                                          
						aereo_id_evento,
						aereo_cpf_particip,
						aereo_transfer_tipo,
						aereo_status,						
						aereo_dt_saida,
						aereo_hr_saida,
						aereo_dt_chegada,
						aereo_hr_chegada,
						aereo_cia_aerea,
						aereo_origem,
						aereo_destino,
						aereo_num_voo,
						aereo_localizador,
						aereo_eticket
					FROM                                                                                                            
						aereos_rsvp
					WHERE                                                                                                           
						aereo_id_evento = ".$this->Db->qstr($vp_evento)."    
					AND
						aereo_cpf_particip = ".$this->Db->qstr($_ap_cpf)."
					AND
						aereo_transfer_tipo = 'IN'
					ORDER BY                                                                                                        
						aereo_id_evento, aereo_cpf_particip, aereo_transfer_tipo
					";		                                                                                                            
					 
      $nm_select = $sqltaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstaer = false;
          $this->rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rstaer[0][0])) {							
						$_tr_dt_saida_ida       	= $this->rstaer[0][4];       
						$_tr_hr_saida_ida       	= $this->rstaer[0][5];       
						$_tr_dt_chegada_ida     	= $this->rstaer[0][6];       
						$_tr_hr_chegada_ida     	= $this->rstaer[0][7];       
						$w_ciaida      		       	= $this->rstaer[0][8];       
						$w_origemIda        	 	= $this->rstaer[0][9];       
						$w_destinoIda        		= $this->rstaer[0][10];       
						$_tr_numvoo_ida         	= $this->rstaer[0][11];       
						$_tr_localizador_ida    	= $this->rstaer[0][12];       
						$_tr_eticket_ida       		= $this->rstaer[0][13];   
						$w_aerstatus_ida			= $this->rstaer[0][3];
					} else {                                                                                                        
						$w_ciaida = "NÃO ENCONTRADA";			                                                                                         
					}
				}
				if ($w_ciavolta == "") {
					$w_aerstatus_volta	= '';
					$sqltaer = "								                                                                                             
					SELECT                                                                                                          
						aereo_id_evento,
						aereo_cpf_particip,
						aereo_transfer_tipo,
						aereo_status,						
						aereo_dt_saida,
						aereo_hr_saida,
						aereo_dt_chegada,
						aereo_hr_chegada,
						aereo_cia_aerea,
						aereo_origem,
						aereo_destino,
						aereo_num_voo,
						aereo_localizador,
						aereo_eticket
					FROM                                                                                                            
						aereos_rsvp
					WHERE                                                                                                           
						aereo_id_evento = ".$this->Db->qstr($vp_evento)."    
					AND
						aereo_cpf_particip = ".$this->Db->qstr($_ap_cpf)."     
					AND
						aereo_transfer_tipo = 'OUT'
					ORDER BY                                                                                                        
						aereo_id_evento, aereo_cpf_particip, aereo_transfer_tipo
					";		                                                                                                            
					 
      $nm_select = $sqltaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstaer = false;
          $this->rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rstaer[0][0])) {							
						$_tr_dt_saida_volta       	= $this->rstaer[0][4];       
						$_tr_hr_saida_volta       	= $this->rstaer[0][5];       
						$_tr_dt_chegada_volta     	= $this->rstaer[0][6];       
						$_tr_hr_chegada_volta     	= $this->rstaer[0][7];       
						$w_ciavolta    		       	= $this->rstaer[0][8];       
						$w_origemVolta        	 	= $this->rstaer[0][9];       
						$w_destinoVolta        		= $this->rstaer[0][10];       
						$_tr_numvoo_volta         	= $this->rstaer[0][11];       
						$_tr_localizador_volta    	= $this->rstaer[0][12];       
						$_tr_eticket_volta     		= $this->rstaer[0][13];  						
						$w_aerstatus_volta			= $this->rstaer[0][3];
					} else {                                                                                                        
						$w_ciavolta = "NÃO ENCONTRADA";			                                                                                         
					}
				}
				
				switch($w_aerstatus_ida) {                                                                                      
					case 'A':                                                                                                      
						$w_aerstatus_ida = 'ABERTO';  		                                                                               
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_aerstatus_ida	= 'PENDENTE';                                                                                   
						break;                                                                                                        
					case 'N':                                                                                                      
						$w_aerstatus_ida	= 'NÃO';                                                                                 
						break;	                                                                                                       
					case 'Y':                                                                                                      
						$w_aerstatus_ida	= 'CONFIRMADO';                                                                                 
						break;	        
					case '':
						$w_aerstatus_ida	= 'ABERTO';                                                                                 
						break;	        
				}     				
				switch($w_aerstatus_volta) {                                                                                      
					case 'A':                                                                                                      
						$w_aerstatus_volta = 'ABERTO';  		                                                                               
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_aerstatus_volta	= 'PENDENTE';                                                                                   
						break;                                                                                                        
					case 'N':                                                                                                      
						$w_aerstatus_volta	= 'NÃO';                                                                                 
						break;	                                                                                                       
					case 'Y':                                                                                                      
						$w_aerstatus_volta	= 'CONFIRMADO';                                                                                 
						break;	        
					case '':
						$w_aerstatus_volta	= 'ABERTO';                                                                                 
						break;	        
				}  
				
				$sqlpres = "
				SELECT                                                                                                          
					presencas_rsvp.presenca_cpf_participante,
					presencas_rsvp.presenca_id_evento,
					presencas_rsvp.presenca_status,
					presencas_rsvp.presenca_data_hora,
					presencas_rsvp.presenca__frase_resposta,
					presencas_rsvp.presenca_obs,
					presencas_rsvp.presenca_usuario_id,
					presencas_rsvp.presenca_tipo_part, 
					usuarios_rsvp.usuario_nome
				FROM                                                                                                            
					presencas_rsvp
				RIGHT JOIN 
					usuarios_rsvp
				ON 
					usuarios_rsvp.usuario_id = presencas_rsvp.presenca_usuario_id
				WHERE                                                                                                           
					presencas_rsvp.presenca_cpf_participante = ".$this->Db->qstr($_ap_cpf)."                                                                                 
				AND
					presencas_rsvp.presenca_id_evento = ".$this->Db->qstr($vp_evento)."
				ORDER BY                                                                                                        
					presencas_rsvp.presenca_data_hora DESC,
					presencas_rsvp.presenca_id_evento,
					presencas_rsvp.presenca_cpf_participante
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
					$vpresenca_status       = $this->rspres[0][2];
					$vpresenca_data			= $this->rspres[0][3];  
					$vpresenca_motivo       = $this->rspres[0][4];  
					$vpresenca_obs          = $this->rspres[0][5];
					$vpresenca_usuario_id   = $this->rspres[0][6];  
					$vpresenca_tipo_part    = $this->rspres[0][7];
					$vpresenca_usuario_nome	= $this->rspres[0][8];								
					switch($vpresenca_status) {
						case 'Y':
							$vpresenca_status_dsc  = 'SIM';  		  
							break;
						case 'N':
							$vpresenca_status_dsc = 'NÃO'; 
							break;
						case 'A':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;							
						case 'P':
							$vpresenca_status_dsc = 'PENDENTE'; 
							break;	
						case ' ':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;
						case '':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;		
						case 'NULL':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;		
					}					
				} else {
					$vpresenca_status_dsc = 'ABERTO'; 
				}			
				
				
				$sqlcont = "								                                                                                             
				SELECT                                                                                                          
					contatos_rsvp.contato_cpf_participante,
					contatos_rsvp.contato_id_evento,
					contatos_rsvp.contato_status,
					contatos_rsvp.contato_data_hora,
					contatos_rsvp.contato_motivo_frase,
					contatos_rsvp.contato_obs,
					contatos_rsvp.contato_usuario_id,
					usuarios_rsvp.usuario_nome
				FROM                                                                                                            
					contatos_rsvp
				RIGHT JOIN 
					usuarios_rsvp
				ON 
					usuarios_rsvp.usuario_id = contatos_rsvp.contato_usuario_id 							
				WHERE                                                                                                           
					contatos_rsvp.contato_cpf_participante = ".$this->Db->qstr($_ap_cpf)."                                                                            
				AND
					contatos_rsvp.contato_id_evento = ".$this->Db->qstr($vp_evento)."   
				ORDER BY                                                                                                        
					contatos_rsvp.contato_data_hora DESC,
					contato_id_evento,
					contato_cpf_participante
				LIMIT 1						
				";
				 
      $nm_select = $sqlcont; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscont = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscont[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscont = false;
          $this->rscont_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscont[0][0])) {					
					$vcontato_cpf 			= $this->rscont[0][0];			
					$vcontato_status        = $this->rscont[0][2];   
					$vcontato_data          = $this->rscont[0][3];  
					$vcontato_motivo        = $this->rscont[0][4]; 
					$vcontato_obs           = $this->rscont[0][5]; 
					$vcontato_usuario_id    = $this->rscont[0][6];   
					$vcontato_usuario_nome	= $this->rscont[0][7];						
					switch($vcontato_status) {
						case 'Y':
							$vcontato_status_dsc = 'SIM';  		  
							break;
						case 'N':
							$vcontato_status_dsc = 'NÃO'; 
							break;
						case 'A':
							$vcontato_status_dsc = 'ABERTO'; 
							break;							
						case 'P':
							$vcontato_status_dsc = 'PENDENTE'; 
							break;	
						case ' ':
							$vcontato_status_dsc = 'ABERTO'; 							
							break;								
						case '':
							$vcontato_status_dsc = 'ABERTO'; 
							break;		
						case 'NULL':
							$vcontato_status_dsc = 'ABERTO'; 
							break;		
					}	
					$_ap_contato_rsvp = $vcontato_data;
				} else {
					$vcontato_status_dsc = 'ABERTO'; 	
				}	
				$sqlins = "
					SELECT 
						COUNT(cpf) as qtde
					FROM 
						geral_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($_ap_cpf)."    
					AND 
						evento_id = ".$this->Db->qstr($vp_evento)."    
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
							geral_rsvp_r
							(evento_id,               	        
							evento_dsc,                 
							cpf,                                     
							nome_participante,             
							cpf_mestre,                  
							nome_acompanhado,                                       
							tipo_pessoa,                       
							nome_cracha,                       
							convidado_original,           
							nome_substituto,                
							acomp_mesmoquarto,             
							partici_mesmoquarto,         
							checkin,                              
							checkout,                             
							tamanho_camisa,                  
							tamanho_calcado,                
							hotel,                                  
							hotel_dsc,                   	                                
							comprado_bvt,                      
							cargo,                                  
							empresa,                              
							departamento,                      
							grupo,                                  
							publico,                              
							publico_dsc,                                               
							regional,                             
							regional_dsc,                                   
							data_cadastro,                    
							logradouro,                         
							complemento,                       
							bairro,                                
							cidade,                                
							cep,                                     
							uf,                                       
							pais_dsc,                                    
							ddd_tel01,                           
							tel01,                                  
							ddd_celular,                       
							celular,                              
							passaporte,                         
							validade_passporte,           
							rg,                                       
							filiacao,                             
							data_nascimento,                
							fumante,                          
							restricao_alimentar,         
							e_mail,                                
							atualizacao_presenca,        
							presenca,                             
							contato,                              
							trecho,                                            
							hotel_ida,                                           
							hotel_ida_dsc,                                   
							comprada_bvt_ida,                  
							data_saida_ida,        		
							hora_saida_ida,        		
							data_chegada_ida,            
							hora_chegada_ida,            
							cia_aerea_ida,         		
							cia_dsc_ida,           		
							origem_ida,            		
							origem_dsc_ida,        		
							destino_ida,           		
							destino_dsc_ida,       		
							voo_ida,               		
							localizador_ida,				  
							etkt_ida,              		
							hotel_volta,           		
							hotel_volta_dsc,       		
							comprada_bvt_volta,    		
							hr_transfer_volta,     		
							data_saida_volta,      		
							hora_saida_volta,            
							data_chegada_volta,          
							hora_chegada_volta,          
							cia_aerea_volta,       		
							cia_dsc_volta,         		
							origem_volta,				  
							origem_dsc_volta,      		
							destino_volta,         		
							destino_dsc_volta,     		
							voo_volta,             		
							localizador_volta,     		
							etkt_volta,            		
							obs_transfer,          		
							id_usuario_relato,     		
							usuario_relato_dsc,    		
							tipo_transfer,         		
							early_checkin,         		
							late_checkout,         		
							trecho_volta,
							dt_chegada_proprio,
							hr_chegada_proprio,
							status_aereo_ida,
							status_aereo_volta,
							valor_diaria,
							valor_taxa,
							dt_confirm_presenca,
							presenca_motivo,
							presenca_atendente,
							presenca_obs,
							contato_antendente,
							data_contato,
							motivo_contato,
							obs_contato,
							status_contato,
							anotacoes,
							telefone_internacional)		
						VALUES
							('".$_ap_id_evento."',          
							'".$w_eventoDsc."',         
							'".$_ap_cpf."',                
							'".$_ap_nome."',               
							'".$_ap_cpf_mestre."',      
							'".$_ap_nome_acompanhado."', 	
							'".$w_tipopess."',             
							'".$_ap_nome_cracha."',        
							'".$_guardaNome."',            
							'".$_ap_nome_substituto."',    
							'".$_ho_acompanhante."',       
							'".$_ho_part_acomp."',         
							'".$_ho_dt_checkin."',         
							'".$_ho_dt_checkout."',        
							'".$_ap_tam_camisa."',         
							'".$_ap_tam_calcado."',        
							'".$_ho_id_hotel."',           
							'".$w_hotel_dsc."',			
							'".$_ho_reserva_bvt."',        
							'".$_ap_cargo."',              
							'".$_ap_empresa."',            
							'".$_ap_departamento."',       
							'".$_ap_grupo."',              
							'".$_ap_id_evento_publico."',  
							'".$w_publico."',				
							'".$_ap_id_evento_regional."', 
							'".$w_regional."',             
							'".$_ap_dt_cadastro."',        
							'".$_ap_logradouro."',         
							'".$_ap_complemento."',        
							'".$_ap_bairro."',             
							'".$_ap_cidade."',             
							'".$_ap_cep."',                
							'".$_ap_uf."',	                
							'".$w_pais."',               
							'".$_ap_ddd_01."',             
							'".$_ap_fone_01."',            
							'".$_ap_ddd_celular_01."',     
							'".$_ap_celeular_01."',        
							'".$_ap_passaporte."',         
							'".$_ap_validade_pass."',      
							'".$_ap_rg."',                 
							'".$_ap_filiacao."',           
							'".$_ap_dt_nasc."',            
							'".$_ap_fumante."',            
							'".$_ap_restricao_alimentar."',
							'".$_ap_email."',              
							'".$_ap_dt_alt_presenca."',    
							'".$_ap_presenca."',           
							'".$_ap_contato_rsvp."',       
							'".$_trecho_ida."',            
							'".$_ho_id_hotel."',           
							'".$w_hotel_dsc."',            
							'".$_ho_reserva_bvt."',        
							'".$_tr_dt_saida_ida."', 
							'".$_tr_hr_saida_ida."',
							'".$_tr_dt_chegada_ida."',
							'".$_tr_hr_chegada_ida."',
							'".$_tr_cia_ida."', 
							'".$w_ciaida."',
							'".$_tr_origem_ida."',
							'".$w_origemIda."',
							'".$_tr_destino_ida."',
							'".$w_destinoIda."',
							'".$_tr_numvoo_ida."',
							'".$_tr_localizador_ida."',    
							'".$_tr_eticket_ida."',
							'".$_tr_id_hotel_out."',
							'".$w_hotel_dsc_out."',
							'".$w_comprada_bvt."',
							'".$_tr_hrtransout."',
							'".$_tr_dt_saida_volta."',
							'".$_tr_hr_saida_volta."',	 
							'".$_tr_dt_chegada_volta."',
							'".$_tr_hr_chegada_volta."',
							'".$_tr_cia_volta."',
							'".$w_ciavolta."',
							'".$_tr_origem_volta."',       
							'".$w_origemVolta."',
							'".$_tr_destino_volta."',
							'".$w_destinoVolta."',
							'".$_tr_numvoo_volta."',
							'".$_tr_localizador_volta."',
							'".$_tr_eticket_volta."',
							'".$_tr_observacao."',
							'".$vp_usuario."',
							'".$w_usurelDsc."',
							'".$_tr_tipo_transfer."',
							'".$_ho_early_chkin."',
							'".$_ho_late_chkout."',
							'".$_trecho_volta."',					
							'".$_tr_dt_chegada_prop."',		
							'".$_tr_hr_chegada_prop."',
							'".$w_aerstatus_ida."',
							'".$w_aerstatus_volta."',
							'".$_ho_hosp_diarias."',
							'".$_ho_hosp_taxas."',
							'".$vpresenca_data."',
							'".$vpresenca_motivo."',
							'".$vpresenca_usuario_nome."',
							'".$vpresenca_obs."',
							'".$vcontato_usuario_nome."',
							'".$vcontato_data."',
							'".$vcontato_motivo."',
							'".$vcontato_obs."',
							'".$vcontato_status_dsc."',
							'".$_an_anota_dsc."',
							'".$w_foneinter."')	
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
					
				} else {
					
					
				}	
			}
			$ret = 'ADICIONA OK'; 			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}			
		return $ret;
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}

}

?>
