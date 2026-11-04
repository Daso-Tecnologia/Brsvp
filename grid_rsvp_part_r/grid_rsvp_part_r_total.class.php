<?php

class grid_rsvp_part_r_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_rsvp_part_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_rsvp_part_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->p_tam_camisa = (isset($Busca_temp['p_tam_camisa'])) ? $Busca_temp['p_tam_camisa'] : ""; 
          $tmp_pos = (is_string($this->p_tam_camisa)) ? strpos($this->p_tam_camisa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->p_tam_camisa))
          {
              $this->p_tam_camisa = substr($this->p_tam_camisa, 0, $tmp_pos);
          }
          $this->publico_nome = (isset($Busca_temp['publico_nome'])) ? $Busca_temp['publico_nome'] : ""; 
          $tmp_pos = (is_string($this->publico_nome)) ? strpos($this->publico_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_nome))
          {
              $this->publico_nome = substr($this->publico_nome, 0, $tmp_pos);
          }
          $this->regional_nome = (isset($Busca_temp['regional_nome'])) ? $Busca_temp['regional_nome'] : ""; 
          $tmp_pos = (is_string($this->regional_nome)) ? strpos($this->regional_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional_nome))
          {
              $this->regional_nome = substr($this->regional_nome, 0, $tmp_pos);
          }
          $this->p_nome = (isset($Busca_temp['p_nome'])) ? $Busca_temp['p_nome'] : ""; 
          $tmp_pos = (is_string($this->p_nome)) ? strpos($this->p_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->p_nome))
          {
              $this->p_nome = substr($this->p_nome, 0, $tmp_pos);
          }
          $this->contato_status_dsc = (isset($Busca_temp['contato_status_dsc'])) ? $Busca_temp['contato_status_dsc'] : ""; 
          $tmp_pos = (is_string($this->contato_status_dsc)) ? strpos($this->contato_status_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->contato_status_dsc))
          {
              $this->contato_status_dsc = substr($this->contato_status_dsc, 0, $tmp_pos);
          }
          $this->presenca_status_dsc = (isset($Busca_temp['presenca_status_dsc'])) ? $Busca_temp['presenca_status_dsc'] : ""; 
          $tmp_pos = (is_string($this->presenca_status_dsc)) ? strpos($this->presenca_status_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca_status_dsc))
          {
              $this->presenca_status_dsc = substr($this->presenca_status_dsc, 0, $tmp_pos);
          }
          $this->hotel_fantasia = (isset($Busca_temp['hotel_fantasia'])) ? $Busca_temp['hotel_fantasia'] : ""; 
          $tmp_pos = (is_string($this->hotel_fantasia)) ? strpos($this->hotel_fantasia, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_fantasia))
          {
              $this->hotel_fantasia = substr($this->hotel_fantasia, 0, $tmp_pos);
          }
          $this->contato_usuario_nome = (isset($Busca_temp['contato_usuario_nome'])) ? $Busca_temp['contato_usuario_nome'] : ""; 
          $tmp_pos = (is_string($this->contato_usuario_nome)) ? strpos($this->contato_usuario_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->contato_usuario_nome))
          {
              $this->contato_usuario_nome = substr($this->contato_usuario_nome, 0, $tmp_pos);
          }
          $this->presenca_usuario_dsc = (isset($Busca_temp['presenca_usuario_dsc'])) ? $Busca_temp['presenca_usuario_dsc'] : ""; 
          $tmp_pos = (is_string($this->presenca_usuario_dsc)) ? strpos($this->presenca_usuario_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca_usuario_dsc))
          {
              $this->presenca_usuario_dsc = substr($this->presenca_usuario_dsc, 0, $tmp_pos);
          }
          $this->hospedagem_tipo_pessoa = (isset($Busca_temp['hospedagem_tipo_pessoa'])) ? $Busca_temp['hospedagem_tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_tipo_pessoa)) ? strpos($this->hospedagem_tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_tipo_pessoa))
          {
              $this->hospedagem_tipo_pessoa = substr($this->hospedagem_tipo_pessoa, 0, $tmp_pos);
          }
          $this->hospedagem_dtchkin = (isset($Busca_temp['hospedagem_dtchkin'])) ? $Busca_temp['hospedagem_dtchkin'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_dtchkin)) ? strpos($this->hospedagem_dtchkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_dtchkin))
          {
              $this->hospedagem_dtchkin = substr($this->hospedagem_dtchkin, 0, $tmp_pos);
          }
          $hospedagem_dtchkin_2 = (isset($Busca_temp['hospedagem_dtchkin_input_2'])) ? $Busca_temp['hospedagem_dtchkin_input_2'] : ""; 
          $this->hospedagem_dtchkin_2 = $hospedagem_dtchkin_2; 
          $this->hospedagem_hrchkin = (isset($Busca_temp['hospedagem_hrchkin'])) ? $Busca_temp['hospedagem_hrchkin'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_hrchkin)) ? strpos($this->hospedagem_hrchkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_hrchkin))
          {
              $this->hospedagem_hrchkin = substr($this->hospedagem_hrchkin, 0, $tmp_pos);
          }
          $this->hospedagem_dtchkout = (isset($Busca_temp['hospedagem_dtchkout'])) ? $Busca_temp['hospedagem_dtchkout'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_dtchkout)) ? strpos($this->hospedagem_dtchkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_dtchkout))
          {
              $this->hospedagem_dtchkout = substr($this->hospedagem_dtchkout, 0, $tmp_pos);
          }
          $hospedagem_dtchkout_2 = (isset($Busca_temp['hospedagem_dtchkout_input_2'])) ? $Busca_temp['hospedagem_dtchkout_input_2'] : ""; 
          $this->hospedagem_dtchkout_2 = $hospedagem_dtchkout_2; 
          $this->hospedagem_hrchkout = (isset($Busca_temp['hospedagem_hrchkout'])) ? $Busca_temp['hospedagem_hrchkout'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_hrchkout)) ? strpos($this->hospedagem_hrchkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_hrchkout))
          {
              $this->hospedagem_hrchkout = substr($this->hospedagem_hrchkout, 0, $tmp_pos);
          }
          $this->presenca_status = (isset($Busca_temp['presenca_status'])) ? $Busca_temp['presenca_status'] : ""; 
          $tmp_pos = (is_string($this->presenca_status)) ? strpos($this->presenca_status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca_status))
          {
              $this->presenca_status = substr($this->presenca_status, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $p_regional, $p_publico;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(p_cpf) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(p_cpf) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(p_cpf) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['tot_geral'][2] = $rt->fields[1]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['contr_total_geral'] = "OK";
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

function BuscaAcomp($evento,$usuario,$ptipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		
		$valor_y = 'Y';
		$sqlj="
			SELECT
				participantes_rsvp.part_cpf AS p_cpf,
				participantes_rsvp.part_id_evento AS p_evento,
				acompanhantes_rsvp.part_id_evento AS ac_evento,
				acompanhantes_rsvp.part_cpf_mestre AS ac_cpf_mestre ,
				acompanhantes_rsvp.part_cpf AS ac_cpf,
				pessoas_rsvp.pessoa_cpf AS pe_cpf,
				pessoas_rsvp.pessoa_nome AS pe_nome
			FROM
				participantes_rsvp
			LEFT JOIN 
				acompanhantes_rsvp
			ON 
				acompanhantes_rsvp.part_cpf_mestre = participantes_rsvp.part_cpf  
			LEFT JOIN 
				pessoas_rsvp
			ON 
				pessoas_rsvp.pessoa_cpf = acompanhantes_rsvp.part_cpf		
			WHERE
				participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."
			AND 
				acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."			
			AND 
				acompanhantes_rsvp.part_cpf_mestre IS NOT NULL	
			ORDER BY
				participantes_rsvp.part_cpf			
		";	
		 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_part = sizeof($this->rsj );
		$v_nome_acompanhante = '';
		$_contador = 1;
		$_atucpf = '';
		if ($reg_part > 0) {
			for ($i=0;$i<$reg_part;++$i) {
				$_antcpf = $this->rsj[$i][0];
				if($_antcpf <> $_atucpf) {
					$v_nome_acompanhante = '';	
					$_contador = 1;
				}	
				$v_cpf_participante = $this->rsj[$i][0];
				
				if ($_contador == 1) {
					$v_nome_acompanhante = $this->rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
							rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;
					}	
				} else {
					$v_nome_acompanhante = $v_nome_acompanhante.';'.$this->rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
								rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;		
					}
				}
				
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
      
				if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

				$_atucpf = $this->rsj[$i][0];
				$_contador = $_contador + 1;
			}			
		}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp($evento,$usuario,$nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  		
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		$nome_empresa = '';
	
		if($nivel == 'CONVIDADO') {
			$sqlconv = "
				SELECT
					evento_id,
					usuario_id,
					nome_empresa
				FROM
					eventos_usuarios_rsvp			
				WHERE	
					evento_id = ".$this->Db->qstr($evento)."
				AND 
					usuario_id = ".$this->Db->qstr($usuario)."	
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
	
		
		$sqld="
		DELETE FROM 
			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
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

		
		$sql="
		SELECT
    		p_evento,
  			id_usuario_relato
		FROM
   			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
		ORDER BY 
			p_evento,
  			id_usuario_relato
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
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_subs = sizeof($this->rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {
			if($nome_empresa == '') {
				$sqlj="				
				SELECT
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional, 
					participantes_rsvp.part_grupo AS p_grupo,
					participantes_rsvp.part_departamento AS p_departamento,	
					participantes_rsvp.part_cargo AS p_cargo,
					participantes_rsvp.part_tam_camisa AS p_tam_camisa,
					participantes_rsvp.part_idioma AS p_idioma,
					participantes_rsvp.part_empresa AS p_empresa,
					participantes_rsvp.part_uf AS p_uf,
					participantes_rsvp.part_pais AS p_pais,
					participantes_rsvp.part_email AS p_email,
					participantes_rsvp.part_email_secretaria AS p_email_secretaria,
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
					participantes_rsvp.part_celeular_01 AS p_celular_01,
					participantes_rsvp.part_ddd_01 AS p_ddd_01,         
					participantes_rsvp.part_fone_01 AS p_fone_01,       
					participantes_rsvp.nome_pessoa AS p_nome,           
					participantes_rsvp.part_cpf AS p_cpf,               
					participantes_rsvp.part_id_evento,                  
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional					
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
				";
							
			} else {
				$sqlj="				
				SELECT
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional, 
					participantes_rsvp.part_grupo AS p_grupo,
					participantes_rsvp.part_departamento AS p_departamento,	
					participantes_rsvp.part_cargo AS p_cargo,
					participantes_rsvp.part_tam_camisa AS p_tam_camisa,
					participantes_rsvp.part_idioma AS p_idioma,
					participantes_rsvp.part_empresa AS p_empresa,
					participantes_rsvp.part_uf AS p_uf,
					participantes_rsvp.part_pais AS p_pais,
					participantes_rsvp.part_email AS p_email,
					participantes_rsvp.part_email_secretaria AS p_email_secretaria,
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
					participantes_rsvp.part_celeular_01 AS p_celular_01,
					participantes_rsvp.part_ddd_01 AS p_ddd_01,         
					participantes_rsvp.part_fone_01 AS p_fone_01,       
					participantes_rsvp.nome_pessoa AS p_nome,           
					participantes_rsvp.part_cpf AS p_cpf,               
					participantes_rsvp.part_id_evento,                  
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."	
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
				";
			}
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($this->rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $this->rsj[$i][0];   
					$vpregional					= $this->rsj[$i][1];   
					$vpgrupo 					= $this->rsj[$i][2];	  
					$vpdepartamento 			= $this->rsj[$i][3];	    
					$vpcargo 					= $this->rsj[$i][4];   
					$vptam_camisa           	= $this->rsj[$i][5];   
					$vpidioma               	= $this->rsj[$i][6];   
					$vpempresa              	= $this->rsj[$i][7];   
					$vpuf                   	= $this->rsj[$i][8];   
					$vppais                 	= $this->rsj[$i][9];   
					$vpemail                	= $this->rsj[$i][10];  
					$vpemail_secretaria     	= $this->rsj[$i][11];  
					$vpddd_celular_01       	= $this->rsj[$i][12];    
					$vpcelular_01           	= $this->rsj[$i][13];  
					$vpddd_01               	= $this->rsj[$i][14];  
					$vpfone_01              	= $this->rsj[$i][15];  
					$vpnome                 	= $this->rsj[$i][16];  
					$vpcpf                  	= $this->rsj[$i][17];  
					$vpevento               	= $this->rsj[$i][18];  
					$vpublico_nome				= $this->rsj[$i][19];
					$vregional_nome				= $this->rsj[$i][20];  
					
					$vdtnasc					= $this->rsj[$i][21];  
					$vrg						= $this->rsj[$i][22]; 
					$vpartcpf					= $this->rsj[$i][23]; 
					$vanotacoes					= $this->rsj[$i][24]; 
					$vfoneinter					= $this->rsj[$i][25]; 	
										
					$vcontato_cpf            	= '';  
					$vcontato_status         	= '';  
					$vcontato_data           	= ''; 
					$vcontato_motivo         	= '';
					$vcontato_obs            	= '';
					$vcontato_usuario_id        = '';
					$vcontato_status_dsc        = ''; 

					$vpresenca_tipo_part        = '';
					$vpresenca_status        	= '';
					$vpresenca_obs           	= '';
					$vpresenca_motivo        	= '';  
					$vpresenca_data				= '';  
					$vpresenca_usuario_id       = '';  
					$vcontato_usuario_nome		= '';  
					$vpresenca_usuario_nome		= '';  			
					$vpresenca_cpf				= '';
					$vpresenca_status_dsc		= ''; 
					
					$vusuario_relato_nome		= ''; 
					$vusuario_relato_dsc		= ''; 
					$vacompanhantes_nomes		= ''; 

					$vhospedagem_cpf           	= '';
					$vhospedagem_evento        	= '';
					$vhospedagem_id_hotel      	= '';
					$vhospedagem_dtchkin       	= '';
					$vhospedagem_hrchkin       	= '';
					$vhospedagem_dtchkout      	= '';
					$vhospedagem_hrchkout      	= '';
					$vhospedagem_acompanhante  	= '';
					$vhospedagem_tipo_pessoa   	= '';
					$vhotel_fantasia           	= '';
					$vid_usuario_relato_id		= $this->sc_temp_vg_usuario_id;
					
					if($vpartcpf == '') {
						$vpartcpf = $vpcpf;
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
						contatos_rsvp.contato_cpf_participante = '".$vpcpf."'                                                                                 
					AND
						contatos_rsvp.contato_id_evento = '".$vpevento."'
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
					} else {
						$vcontato_status_dsc = 'ABERTO'; 	
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
						presencas_rsvp.presenca_cpf_participante = ".$this->Db->qstr($vpcpf)."                                                                                 
					AND
						presencas_rsvp.presenca_id_evento = ".$this->Db->qstr($vpevento)."
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
					$sqlins = "
						SELECT 
							COUNT(p_cpf) as qtde
						FROM 
							rsvp_part_r
						WHERE 
							p_cpf = ".$this->Db->qstr($vpcpf)." 
						AND 
							p_evento = ".$this->Db->qstr($vpevento)."		
						AND 
    						id_usuario_relato = ".$this->Db->qstr($usuario)."	
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
						$sqli="					
						INSERT INTO   
							rsvp_part_r  
							(p_publico, 						
							p_regional,				    
							p_grupo, 				    
							p_departamento, 		    
							p_cargo, 				    
							p_tam_camisa,               
							p_idioma,                   
							p_empresa,                  
							p_uf,                       
							p_pais,                     
							p_email,                    
							p_email_secretaria,         
							p_ddd_celular_01,           
							p_celular_01,               
							p_ddd_01,                   
							p_fone_01,                  
							p_nome,                     
							p_cpf,                      
							p_evento,                   
							contato_cpf,                
							contato_status,             
							contato_data,               
							contato_motivo,             
							contato_obs,                
							presenca_tipo_part,         
							presenca_status,            
							presenca_obs,               
							presenca_motivo,            
							hospedagem_cpf,             
							hospedagem_evento,          
							hospedagem_id_hotel,        
							hospedagem_dtchkin,         
							hospedagem_hrchkin,         
							hospedagem_dtchkout,        
							hospedagem_hrchkout,        
							hospedagem_acompanhante,    
							hospedagem_tipo_pessoa,     
							hotel_fantasia,             
							publico_nome,               
							regional_nome,              
							id_usuario_relato, 		    
							contato_status_dsc,         
							presenca_status_dsc,        
							contato_usuario_id,         
							contato_usuario_nome,       
							presenca_data,
							presenca_usuario_id,
							presenca_usuario_dsc,
							data_nascimento,
							rg,
							cpf_informado,
							anotacoes,
							telefone_internacional)	             
						VALUES
							(".$this->Db->qstr($vppublico).",	
							".$this->Db->qstr($vpregional).",	
							".$this->Db->qstr($vpgrupo).",	
							".$this->Db->qstr($vpdepartamento).",
							".$this->Db->qstr($vpcargo).",
							".$this->Db->qstr($vptam_camisa).",
							".$this->Db->qstr($vpidioma).",
							".$this->Db->qstr($vpempresa).",
							".$this->Db->qstr($vpuf).",
							".$this->Db->qstr($vppais).",
							".$this->Db->qstr($vpemail).",
							".$this->Db->qstr($vpemail_secretaria).",
							".$this->Db->qstr($vpddd_celular_01).",
							".$this->Db->qstr($vpcelular_01).",
							".$this->Db->qstr($vpddd_01).",
							".$this->Db->qstr($vpfone_01).",
							".$this->Db->qstr($vpnome).",
							".$this->Db->qstr($vpcpf).",
							".$this->Db->qstr($vpevento).",
							".$this->Db->qstr($vcontato_cpf).",
							".$this->Db->qstr($vcontato_status).",
							".$this->Db->qstr($vcontato_data).",
							".$this->Db->qstr($vcontato_motivo).",
							".$this->Db->qstr($vcontato_obs).",
							".$this->Db->qstr($vpresenca_tipo_part).",
							".$this->Db->qstr($vpresenca_status).",
							".$this->Db->qstr($vpresenca_obs).",
							".$this->Db->qstr($vpresenca_motivo).",
							".$this->Db->qstr($vhospedagem_cpf).",
							".$this->Db->qstr($vhospedagem_evento).",
							".$this->Db->qstr($vhospedagem_id_hotel).",
							".$this->Db->qstr($vhospedagem_dtchkin).",
							".$this->Db->qstr($vhospedagem_hrchkin).",
							".$this->Db->qstr($vhospedagem_dtchkout).",
							".$this->Db->qstr($vhospedagem_hrchkout).",
							".$this->Db->qstr($vhospedagem_acompanhante).",
							".$this->Db->qstr($vhospedagem_tipo_pessoa).",
							".$this->Db->qstr($vhotel_fantasia).",
							".$this->Db->qstr($vpublico_nome).",
							".$this->Db->qstr($vregional_nome).",
							".$this->Db->qstr($vid_usuario_relato_id).",
							".$this->Db->qstr($vcontato_status_dsc).",
							".$this->Db->qstr($vpresenca_status_dsc).",
							".$this->Db->qstr($vcontato_usuario_id).",
							".$this->Db->qstr($vcontato_usuario_nome).",															
							".$this->Db->qstr($vpresenca_data).",
							".$this->Db->qstr($vpresenca_usuario_id).",
							".$this->Db->qstr($vpresenca_usuario_nome).",
							".$this->Db->qstr($vdtnasc).",
							".$this->Db->qstr($vrg).",
							".$this->Db->qstr($vpartcpf).",							
							".$this->Db->qstr($vanotacoes).",
							".$this->Db->qstr($vfoneinter).")
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
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp2($evento,$usuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		
		
		$sqld="
		DELETE FROM 
			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
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

		
		
		$sql="
		SELECT
    		p_evento,
  			id_usuario_relato
		FROM
   			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
		ORDER BY 
			p_evento,
  			id_usuario_relato
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
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_subs = sizeof($this->rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {	
			$sqlj="	
			SELECT
				participantes_rsvp.part_id_evento_publico AS p_publico,
				participantes_rsvp.part_id_evento_regional AS p_regional, 
				participantes_rsvp.part_grupo AS p_grupo,
				participantes_rsvp.part_departamento AS p_departamento,	
				participantes_rsvp.part_cargo AS p_cargo,
				participantes_rsvp.part_tam_camisa AS p_tam_camisa,
				participantes_rsvp.part_idioma AS p_idioma,
				participantes_rsvp.part_empresa AS p_empresa,
				participantes_rsvp.part_uf AS p_uf,
				participantes_rsvp.part_pais AS p_pais,
				participantes_rsvp.part_email AS p_email,
				participantes_rsvp.part_email_secretaria AS p_email_secretaria,
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
				participantes_rsvp.part_celeular_01 AS p_celular_01,
				participantes_rsvp.part_ddd_01 AS p_ddd_01,         
				participantes_rsvp.part_fone_01 AS p_fone_01,       
				participantes_rsvp.nome_pessoa AS p_nome,           
				participantes_rsvp.part_cpf AS p_cpf,               
				participantes_rsvp.part_id_evento,                  
				contatos_rsvp.contato_cpf_participante AS contato_cpf,
				contatos_rsvp.contato_status AS contato_status,       
				contatos_rsvp.contato_data_hora AS contato_data,      
				contatos_rsvp.contato_motivo_frase AS contato_motivo, 
				contatos_rsvp.contato_obs AS contato_obs,             
				contatos_rsvp.contato_usuario_id,
				presencas_rsvp.presenca_tipo_part AS presenca_tipo_part,
				presencas_rsvp.presenca_status AS presenca_status,	
				presencas_rsvp.presenca_obs AS presenca_obs,
				presencas_rsvp.presenca__frase_resposta AS presenca_motivo,
				presencas_rsvp.presenca_data_hora, 
				presencas_rsvp.presenca_usuario_id,
				usuarios_rsvp.usuario_nome AS usuario_contato,
				usuarios_rsvp.usuario_nome AS usuario_presenca,
				publico_rsvp.publico_nome,
				tbl_regionais.regional_dsc
			FROM
				participantes_rsvp
			LEFT JOIN 
				contatos_rsvp 
			ON 
				participantes_rsvp.part_cpf  = contatos_rsvp.contato_cpf_participante
			LEFT JOIN 
				presencas_rsvp
			ON 
				participantes_rsvp.part_cpf = presencas_rsvp.presenca_cpf_participante
			LEFT JOIN
				publico_rsvp
			ON 
				publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
			LEFT JOIN
				tbl_regionais
			ON
				tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional
			LEFT JOIN
				usuarios_rsvp
			ON
				usuarios_rsvp.usuario_id = contatos_rsvp.contato_usuario_id	
			AND 	
				usuarios_rsvp.usuario_id = presencas_rsvp.presenca_usuario_id		
			WHERE
				participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
			AND
				participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
			GROUP by
				participantes_rsvp.part_cpf		
			ORDER BY				 
				participantes_rsvp.nome_pessoa,
				contatos_rsvp.contato_data_hora DESC,
				presencas_rsvp.presenca_data_hora DESC 		
			";		
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($this->rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $this->rsj[$i][0];   
					$vpregional					= $this->rsj[$i][1];   
					$vpgrupo 					= $this->rsj[$i][2];	  
					$vpdepartamento 			= $this->rsj[$i][3];	  
					$vpcargo 					= $this->rsj[$i][4];   
					$vptam_camisa           	= $this->rsj[$i][5];   
					$vpidioma               	= $this->rsj[$i][6];   
					$vpempresa              	= $this->rsj[$i][7];   
					$vpuf                   	= $this->rsj[$i][8];   
					$vppais                 	= $this->rsj[$i][9];   
					$vpemail                	= $this->rsj[$i][10];  
					$vpemail_secretaria     	= $this->rsj[$i][11];  
					$vpddd_celular_01       	= $this->rsj[$i][12];  
					$vpcelular_01           	= $this->rsj[$i][13];  
					$vpddd_01               	= $this->rsj[$i][14];  
					$vpfone_01              	= $this->rsj[$i][15];  
					$vpnome                 	= $this->rsj[$i][16];  
					$vpcpf                  	= $this->rsj[$i][17];  
					$vpevento               	= $this->rsj[$i][18];  
					$vcontato_cpf            	= $this->rsj[$i][19];  
					$vcontato_status         	= $this->rsj[$i][20];  
					$vcontato_data           	= $this->rsj[$i][21]; 
					$vcontato_motivo         	= $this->rsj[$i][22];
					$vcontato_obs            	= $this->rsj[$i][23];
					$vcontato_usuario_id        = $this->rsj[$i][24];
					$vpresenca_tipo_part        = $this->rsj[$i][25];
					$vpresenca_status        	= $this->rsj[$i][26];
					$vpresenca_obs           	= $this->rsj[$i][27];
					$vpresenca_motivo        	= $this->rsj[$i][28];  
					$vpresenca_data				= $this->rsj[$i][29];  
					$vpresenca_usuario_id       = $this->rsj[$i][30];  
					$vcontato_usuario_nome		= $this->rsj[$i][31];  
					$vpresenca_usuario_nome		= $this->rsj[$i][32];  
					$vpublico_nome				= $this->rsj[$i][33];  
					$vregional_nome				= $this->rsj[$i][34];  

					$vcontato_status_dsc        = ''; 
					$vpresenca_status_dsc		= ''; 
					$vusuario_relato_nome		= ''; 
					$vusuario_relato_dsc		= ''; 
					$vacompanhantes_nomes		= ''; 

					$vhospedagem_cpf           	= '';
					$vhospedagem_evento        	= '';
					$vhospedagem_id_hotel      	= '';
					$vhospedagem_dtchkin       	= '';
					$vhospedagem_hrchkin       	= '';
					$vhospedagem_dtchkout      	= '';
					$vhospedagem_hrchkout      	= '';
					$vhospedagem_acompanhante  	= '';
					$vhospedagem_tipo_pessoa   	= '';
					$vhotel_fantasia           	= '';
					$vid_usuario_relato_id		= $this->sc_temp_vg_usuario_id;
							
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
					if ($vcontato_cpf == '') {
						$vcontato_status_dsc = 'ABERTO'; 	
					}
					
					$sqli="					
					INSERT INTO   
						rsvp_part_r  
						(p_publico, 						
						p_regional,				    
						p_grupo, 				    
						p_departamento, 		    
						p_cargo, 				    
						p_tam_camisa,               
						p_idioma,                   
						p_empresa,                  
						p_uf,                       
						p_pais,                     
						p_email,                    
						p_email_secretaria,         
						p_ddd_celular_01,           
						p_celular_01,               
						p_ddd_01,                   
						p_fone_01,                  
						p_nome,                     
						p_cpf,                      
						p_evento,                   
						contato_cpf,                
						contato_status,             
						contato_data,               
						contato_motivo,             
						contato_obs,                
						presenca_tipo_part,         
						presenca_status,            
						presenca_obs,               
						presenca_motivo,            
						hospedagem_cpf,             
						hospedagem_evento,          
						hospedagem_id_hotel,        
						hospedagem_dtchkin,         
						hospedagem_hrchkin,         
						hospedagem_dtchkout,        
						hospedagem_hrchkout,        
						hospedagem_acompanhante,    
						hospedagem_tipo_pessoa,     
						hotel_fantasia,             
						publico_nome,               
						regional_nome,              
						id_usuario_relato, 		    
						contato_status_dsc,         
						presenca_status_dsc,        
						contato_usuario_id,         
						contato_usuario_nome,       
						presenca_data,
						presenca_usuario_id,
						presenca_usuario_dsc)	             
					VALUES
						(".$this->Db->qstr($vppublico).",	
						".$this->Db->qstr($vpregional).",	
						".$this->Db->qstr($vpgrupo).",	
						".$this->Db->qstr($vpdepartamento).",
						".$this->Db->qstr($vpcargo).",
						".$this->Db->qstr($vptam_camisa).",
						".$this->Db->qstr($vpidioma).",
						".$this->Db->qstr($vpempresa).",
						".$this->Db->qstr($vpuf).",
						".$this->Db->qstr($vppais).",
						".$this->Db->qstr($vpemail).",
						".$this->Db->qstr($vpemail_secretaria).",
						".$this->Db->qstr($vpddd_celular_01).",
						".$this->Db->qstr($vpcelular_01).",
						".$this->Db->qstr($vpddd_01).",
						".$this->Db->qstr($vpfone_01).",
						".$this->Db->qstr($vpnome).",
						".$this->Db->qstr($vpcpf).",
						".$this->Db->qstr($vpevento).",
						".$this->Db->qstr($vcontato_cpf).",
						".$this->Db->qstr($vcontato_status).",
						".$this->Db->qstr($vcontato_data).",
						".$this->Db->qstr($vcontato_motivo).",
						".$this->Db->qstr($vcontato_obs).",
						".$this->Db->qstr($vpresenca_tipo_part).",
						".$this->Db->qstr($vpresenca_status).",
						".$this->Db->qstr($vpresenca_obs).",
						".$this->Db->qstr($vpresenca_motivo).",
						".$this->Db->qstr($vhospedagem_cpf).",
						".$this->Db->qstr($vhospedagem_evento).",
						".$this->Db->qstr($vhospedagem_id_hotel).",
						".$this->Db->qstr($vhospedagem_dtchkin).",
						".$this->Db->qstr($vhospedagem_hrchkin).",
						".$this->Db->qstr($vhospedagem_dtchkout).",
						".$this->Db->qstr($vhospedagem_hrchkout).",
						".$this->Db->qstr($vhospedagem_acompanhante).",
						".$this->Db->qstr($vhospedagem_tipo_pessoa).",
						".$this->Db->qstr($vhotel_fantasia).",
						".$this->Db->qstr($vpublico_nome).",
						".$this->Db->qstr($vregional_nome).",
						".$this->Db->qstr($vid_usuario_relato_id).",
						".$this->Db->qstr($vcontato_status_dsc).",
						".$this->Db->qstr($vpresenca_status_dsc).",
						".$this->Db->qstr($vcontato_usuario_id).",
						".$this->Db->qstr($vcontato_usuario_nome).",
						".$this->Db->qstr($vpresenca_data).",
						".$this->Db->qstr($vpresenca_usuario_id).",
						".$this->Db->qstr($vpresenca_usuario_nome).")
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
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}

}

?>
