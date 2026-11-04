<?php

class grid_trprop_rsvp_r_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_trprop_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_trprop_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
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
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->participante = (isset($Busca_temp['participante'])) ? $Busca_temp['participante'] : ""; 
          $tmp_pos = (is_string($this->participante)) ? strpos($this->participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante))
          {
              $this->participante = substr($this->participante, 0, $tmp_pos);
          }
          $this->empresa = (isset($Busca_temp['empresa'])) ? $Busca_temp['empresa'] : ""; 
          $tmp_pos = (is_string($this->empresa)) ? strpos($this->empresa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->empresa))
          {
              $this->empresa = substr($this->empresa, 0, $tmp_pos);
          }
          $this->publico = (isset($Busca_temp['publico'])) ? $Busca_temp['publico'] : ""; 
          $tmp_pos = (is_string($this->publico)) ? strpos($this->publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico))
          {
              $this->publico = substr($this->publico, 0, $tmp_pos);
          }
          $this->regional = (isset($Busca_temp['regional'])) ? $Busca_temp['regional'] : ""; 
          $tmp_pos = (is_string($this->regional)) ? strpos($this->regional, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional))
          {
              $this->regional = substr($this->regional, 0, $tmp_pos);
          }
          $this->hotel = (isset($Busca_temp['hotel'])) ? $Busca_temp['hotel'] : ""; 
          $tmp_pos = (is_string($this->hotel)) ? strpos($this->hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel))
          {
              $this->hotel = substr($this->hotel, 0, $tmp_pos);
          }
          $this->ddd_celular = (isset($Busca_temp['ddd_celular'])) ? $Busca_temp['ddd_celular'] : ""; 
          $tmp_pos = (is_string($this->ddd_celular)) ? strpos($this->ddd_celular, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ddd_celular))
          {
              $this->ddd_celular = substr($this->ddd_celular, 0, $tmp_pos);
          }
          $this->data_chegada = (isset($Busca_temp['data_chegada'])) ? $Busca_temp['data_chegada'] : ""; 
          $tmp_pos = (is_string($this->data_chegada)) ? strpos($this->data_chegada, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_chegada))
          {
              $this->data_chegada = substr($this->data_chegada, 0, $tmp_pos);
          }
          $data_chegada_2 = (isset($Busca_temp['data_chegada_input_2'])) ? $Busca_temp['data_chegada_input_2'] : ""; 
          $this->data_chegada_2 = $data_chegada_2; 
          $this->hora_chegada = (isset($Busca_temp['hora_chegada'])) ? $Busca_temp['hora_chegada'] : ""; 
          $tmp_pos = (is_string($this->hora_chegada)) ? strpos($this->hora_chegada, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hora_chegada))
          {
              $this->hora_chegada = substr($this->hora_chegada, 0, $tmp_pos);
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trprop_rsvp_r']['contr_total_geral'] = "OK";
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
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'off';
}


function PrepRepro($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;
		$ret = 'ADICIONA ERRO';	
		$valor_y = 'Y';
		$valor_p = 'P';
	
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
			trprop_rsvp_r
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
			if($vp_nivel <> 'CONVIDADO') {
				
				$sqlMestre = "			
				SELECT
				participantes_rsvp.part_id_evento AS evt,                  
				participantes_rsvp.nome_pessoa AS p_nome,                  
				participantes_rsvp.part_dt_nasc AS dt_nasc,		           
				participantes_rsvp.part_rg AS rg,                          
				transfer_rsvp.tra_cpf_particip AS cpf,                     
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
				participantes_rsvp.part_celeular_01 AS p_celular_01,       
				participantes_rsvp.part_id_evento_publico AS p_publico,    
				publico_rsvp.publico_nome,                                 
				participantes_rsvp.part_id_evento_regional AS p_regional,  
				tbl_regionais.regional_dsc,	  	                           
				participantes_rsvp.part_empresa,                           
				participantes_rsvp.part_cargo,	                           
				transfer_rsvp.tra_dt_chegada_proprio,                      
				transfer_rsvp.tra_hr_chegada_proprio,                      
				transfer_rsvp.tra_id_hotel AS Hotel,                       
				tbl_hoteis.hotel_fantasia AS Hotfant,  	                   
				transfer_rsvp.tra_tipo AS tipo_transfer,		           
				transfer_rsvp.tra_status AS t_status,                      
				transfer_rsvp.tra_ativo AS ativo,                          
				participantes_rsvp.part_cod_usuario AS usuario,            
				transfer_rsvp.tra_observacao AS obs,			               
				transfer_rsvp.tra_tipo_pessoa                              
				FROM
					transfer_rsvp
				LEFT JOIN 
					participantes_rsvp	
				ON 	
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
				LEFT JOIN
					tbl_hoteis
				ON
					tbl_hoteis.hotel_id = transfer_rsvp.tra_id_hotel
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional				
				WHERE
					transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf
				AND	
					participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."	
				GROUP BY
					transfer_rsvp.tra_cpf_particip		
				ORDER BY				 
					participantes_rsvp.nome_pessoa		
				";	
			} else {
				
				$sqlMestre = "			
				SELECT
				participantes_rsvp.part_id_evento AS evt,                  
				participantes_rsvp.nome_pessoa AS p_nome,                  
				participantes_rsvp.part_dt_nasc AS dt_nasc,		           
				participantes_rsvp.part_rg AS rg,                          
				transfer_rsvp.tra_cpf_particip AS cpf,                     
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
				participantes_rsvp.part_celeular_01 AS p_celular_01,       
				participantes_rsvp.part_id_evento_publico AS p_publico,    
				publico_rsvp.publico_nome,                                 
				participantes_rsvp.part_id_evento_regional AS p_regional,  
				tbl_regionais.regional_dsc,	  	                           
				participantes_rsvp.part_empresa,                           
				participantes_rsvp.part_cargo,	                           
				transfer_rsvp.tra_dt_chegada_proprio,                      
				transfer_rsvp.tra_hr_chegada_proprio,                      
				transfer_rsvp.tra_id_hotel AS Hotel,                       
				tbl_hoteis.hotel_fantasia AS Hotfant,  	                   
				transfer_rsvp.tra_tipo AS tipo_transfer,		           
				transfer_rsvp.tra_status AS t_status,                      
				transfer_rsvp.tra_ativo AS ativo,                          
				participantes_rsvp.part_cod_usuario AS usuario,            
				transfer_rsvp.tra_observacao AS obs,			               
				transfer_rsvp.tra_tipo_pessoa,
				participantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				LEFT JOIN 
					participantes_rsvp	
				ON 	
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
				LEFT JOIN
					tbl_hoteis
				ON
					tbl_hoteis.hotel_id = transfer_rsvp.tra_id_hotel
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional				
				WHERE
					transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf
				AND
					participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."	
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."	
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP BY
					transfer_rsvp.tra_cpf_particip		
				ORDER BY				 
					participantes_rsvp.nome_pessoa		
				";					
			}			
			$_passa_part = true;			
		} else {
			if($vp_nivel <> 'CONVIDADO') {
				
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_id_evento AS evt,                  
					acompanhantes_rsvp.part_nome,
					acompanhantes_rsvp.part_dt_nasc AS dt_nasc,		           
					acompanhantes_rsvp.part_rg AS rg,                          
					transfer_rsvp.tra_cpf_particip AS cpf,                     
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01,       
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,    
					publico_rsvp.publico_nome,                                 
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,  
					tbl_regionais.regional_dsc,	  	                           
					acompanhantes_rsvp.part_empresa,                           
					acompanhantes_rsvp.part_cargo,	                           
					transfer_rsvp.tra_dt_chegada_proprio,                      
					transfer_rsvp.tra_hr_chegada_proprio,                      
					transfer_rsvp.tra_id_hotel AS Hotel,                       
					tbl_hoteis.hotel_fantasia AS Hotfant,  	                   
					transfer_rsvp.tra_tipo AS tipo_transfer,		           
					transfer_rsvp.tra_status AS t_status,                      
					transfer_rsvp.tra_ativo AS ativo,                          
					acompanhantes_rsvp.part_cod_usuario AS usuario,            
					transfer_rsvp.tra_observacao AS obs,			           
					transfer_rsvp.tra_tipo_pessoa                              			
				FROM
					transfer_rsvp
				LEFT JOIN 
					acompanhantes_rsvp	
				ON 	
					acompanhantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."	
				LEFT JOIN
					tbl_hoteis
				ON
					tbl_hoteis.hotel_id = transfer_rsvp.tra_id_hotel
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = acompanhantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = acompanhantes_rsvp.part_id_evento_regional				
				WHERE
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf
				AND	
					acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."		
				GROUP BY
					transfer_rsvp.tra_cpf_particip		
				ORDER BY				 
					transfer_rsvp.tra_cpf_particip 				
				";	
			} else {
				
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_id_evento AS evt,                  
					acompanhantes_rsvp.part_nome,
					acompanhantes_rsvp.part_dt_nasc AS dt_nasc,		           
					acompanhantes_rsvp.part_rg AS rg,                          
					transfer_rsvp.tra_cpf_particip AS cpf,                     
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01,       
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,    
					publico_rsvp.publico_nome,                                 
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,  
					tbl_regionais.regional_dsc,	  	                           
					acompanhantes_rsvp.part_empresa,                           
					acompanhantes_rsvp.part_cargo,	                           
					transfer_rsvp.tra_dt_chegada_proprio,                      
					transfer_rsvp.tra_hr_chegada_proprio,                      
					transfer_rsvp.tra_id_hotel AS Hotel,                       
					tbl_hoteis.hotel_fantasia AS Hotfant,  	                   
					transfer_rsvp.tra_tipo AS tipo_transfer,		           
					transfer_rsvp.tra_status AS t_status,                      
					transfer_rsvp.tra_ativo AS ativo,                          
					acompanhantes_rsvp.part_cod_usuario AS usuario,            
					transfer_rsvp.tra_observacao AS obs,			           
					transfer_rsvp.tra_tipo_pessoa,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				LEFT JOIN 
					acompanhantes_rsvp	
				ON 	
					acompanhantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."	
				LEFT JOIN
					tbl_hoteis
				ON
					tbl_hoteis.hotel_id = transfer_rsvp.tra_id_hotel
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = acompanhantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = acompanhantes_rsvp.part_id_evento_regional				
				WHERE
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf
				AND	
					acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."		
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP BY
					transfer_rsvp.tra_cpf_particip		
				ORDER BY				 
					transfer_rsvp.tra_cpf_particip 				
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
					$w_id_evento			= $this->rsm[$i][0];   
					$w_participante			= $this->rsm[$i][1];   
					$w_data_nasc			= $this->rsm[$i][2];   
					$w_rg					= $this->rsm[$i][3];   
					$w_cpf					= $this->rsm[$i][4];   
					$w_ddd_celular			= $this->rsm[$i][5];   
					$w_celular				= $this->rsm[$i][6];   
					$w_publico				= $this->rsm[$i][7];   
					$w_publico_dsc			= $this->rsm[$i][8];   
					$w_regional				= $this->rsm[$i][9];   
					$w_regional_dsc			= $this->rsm[$i][10];  
					$w_empresa				= $this->rsm[$i][11];  
					$w_cargo				= $this->rsm[$i][12];  
					$w_data_chegada			= $this->rsm[$i][13];  
					$w_hora_chegada			= $this->rsm[$i][14];  
					$w_hotel				= $this->rsm[$i][15];  
					$w_hotel_dsc			= $this->rsm[$i][16];  
					$w_tipo_transfer		= $this->rsm[$i][17];  
					$w_status				= $this->rsm[$i][18];  
					$w_ativo				= $this->rsm[$i][19];  
					$w_id_usuario_relato	= $this->rsm[$i][20];  
					$w_observacoes			= $this->rsm[$i][21];
					$w_tipo_pessoa			= $this->rsm[$i][22];  												
				} else {
					$w_id_evento			= $this->rsm[$i][0];   
					$w_participante			= $this->rsm[$i][1];   
					$w_data_nasc			= $this->rsm[$i][2];   
					$w_rg					= $this->rsm[$i][3];   
					$w_cpf					= $this->rsm[$i][4];   
					$w_ddd_celular			= $this->rsm[$i][5];   
					$w_celular				= $this->rsm[$i][6];   
					$w_publico				= $this->rsm[$i][7];   
					$w_publico_dsc			= $this->rsm[$i][8];   
					$w_regional				= $this->rsm[$i][9];   
					$w_regional_dsc			= $this->rsm[$i][10];  
					$w_empresa				= $this->rsm[$i][11];  
					$w_cargo				= $this->rsm[$i][12];  
					$w_data_chegada			= $this->rsm[$i][13];  
					$w_hora_chegada			= $this->rsm[$i][14];  
					$w_hotel				= $this->rsm[$i][15];  
					$w_hotel_dsc			= $this->rsm[$i][16];  
					$w_tipo_transfer		= $this->rsm[$i][17];  
					$w_status				= $this->rsm[$i][18];  
					$w_ativo				= $this->rsm[$i][19];  
					$w_id_usuario_relato	= $this->rsm[$i][20];  
					$w_observacoes			= $this->rsm[$i][21];
					$w_tipo_pessoa			= $this->rsm[$i][22];
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
					$w_tipo_pessoa = 'ACOMPANHANTE';
				} else {
					$w_tipo_pessoa = 'PARTICIPANTE';
				}
				
				$sqlins = "
					SELECT 
						COUNT(cpf) as qtde
					FROM 
						trprop_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($w_cpf)." 
					AND 
						id_evento = ".$this->Db->qstr($w_id_evento)."		
					AND
						tipo_transfer = ".$this->Db->qstr($w_tipo_transfer)."
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
					trprop_rsvp_r		
					(id_evento,		    
					participante,       
					data_nascimento,    
					rg,                 
					cpf,                
					ddd_celular,        
					celular,            
					publico,            
					publico_dsc,        
					regional,           
					regional_dsc,       
					empresa,            
					cargo,              
					data_chegada,       
					hora_chegada,       
					hotel,              
					hotel_dsc,	        
					tipo_transfer,      
					status,             
					ativo,              
					id_usuario_relato,  
					usuario_relato_dsc, 
					observacoes,        
					tipo_pessoa,        
					evento_dsc)	        
				VALUES
					(".$this->Db->qstr($w_id_evento).", 		
					".$this->Db->qstr($w_participante).",     
					".$this->Db->qstr($w_data_nasc).",        
					".$this->Db->qstr($w_rg).",               
					".$this->Db->qstr($w_cpf).",              
					".$this->Db->qstr($w_ddd_celular).",      
					".$this->Db->qstr($w_celular).",          
					".$this->Db->qstr($w_publico).",          
					".$this->Db->qstr($w_publico_dsc).",      
					".$this->Db->qstr($w_regional).",         
					".$this->Db->qstr($w_regional_dsc).",     
					".$this->Db->qstr($w_empresa).",          
					".$this->Db->qstr($w_cargo).",            
					".$this->Db->qstr($w_data_chegada).",     
					".$this->Db->qstr($w_hora_chegada).",     
					".$this->Db->qstr($w_hotel).",            
					".$this->Db->qstr($w_hotel_dsc).",        
					".$this->Db->qstr($w_tipo_transfer).",
					".$this->Db->qstr($w_status).",    
					".$this->Db->qstr($w_ativo).",             
					".$this->Db->qstr($vp_usuario).",
					".$this->Db->qstr($w_usurelDsc).",        
					".$this->Db->qstr($w_observacoes).",      
					".$this->Db->qstr($w_tipo_pessoa).",	    
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
      
				if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
	
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
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trprop_rsvp_r']['contr_erro'] = 'off';
}

}

?>
