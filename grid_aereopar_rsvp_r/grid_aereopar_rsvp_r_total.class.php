<?php

class grid_aereopar_rsvp_r_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_aereopar_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_aereopar_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->participante_cpf = (isset($Busca_temp['participante_cpf'])) ? $Busca_temp['participante_cpf'] : ""; 
          $tmp_pos = (is_string($this->participante_cpf)) ? strpos($this->participante_cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante_cpf))
          {
              $this->participante_cpf = substr($this->participante_cpf, 0, $tmp_pos);
          }
          $this->participante_nome = (isset($Busca_temp['participante_nome'])) ? $Busca_temp['participante_nome'] : ""; 
          $tmp_pos = (is_string($this->participante_nome)) ? strpos($this->participante_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante_nome))
          {
              $this->participante_nome = substr($this->participante_nome, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->cod_cia_aerea = (isset($Busca_temp['cod_cia_aerea'])) ? $Busca_temp['cod_cia_aerea'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_aerea)) ? strpos($this->cod_cia_aerea, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_aerea))
          {
              $this->cod_cia_aerea = substr($this->cod_cia_aerea, 0, $tmp_pos);
          }
          $this->cia_aerea = (isset($Busca_temp['cia_aerea'])) ? $Busca_temp['cia_aerea'] : ""; 
          $tmp_pos = (is_string($this->cia_aerea)) ? strpos($this->cia_aerea, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cia_aerea))
          {
              $this->cia_aerea = substr($this->cia_aerea, 0, $tmp_pos);
          }
          $this->voo = (isset($Busca_temp['voo'])) ? $Busca_temp['voo'] : ""; 
          $tmp_pos = (is_string($this->voo)) ? strpos($this->voo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo))
          {
              $this->voo = substr($this->voo, 0, $tmp_pos);
          }
          $this->direcao = (isset($Busca_temp['direcao'])) ? $Busca_temp['direcao'] : ""; 
          $tmp_pos = (is_string($this->direcao)) ? strpos($this->direcao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->direcao))
          {
              $this->direcao = substr($this->direcao, 0, $tmp_pos);
          }
          $this->origem = (isset($Busca_temp['origem'])) ? $Busca_temp['origem'] : ""; 
          $tmp_pos = (is_string($this->origem)) ? strpos($this->origem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->origem))
          {
              $this->origem = substr($this->origem, 0, $tmp_pos);
          }
          $this->destino = (isset($Busca_temp['destino'])) ? $Busca_temp['destino'] : ""; 
          $tmp_pos = (is_string($this->destino)) ? strpos($this->destino, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->destino))
          {
              $this->destino = substr($this->destino, 0, $tmp_pos);
          }
          $this->localizador = (isset($Busca_temp['localizador'])) ? $Busca_temp['localizador'] : ""; 
          $tmp_pos = (is_string($this->localizador)) ? strpos($this->localizador, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->localizador))
          {
              $this->localizador = substr($this->localizador, 0, $tmp_pos);
          }
          $this->etkt = (isset($Busca_temp['etkt'])) ? $Busca_temp['etkt'] : ""; 
          $tmp_pos = (is_string($this->etkt)) ? strpos($this->etkt, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->etkt))
          {
              $this->etkt = substr($this->etkt, 0, $tmp_pos);
          }
          $this->emitida_bvt = (isset($Busca_temp['emitida_bvt'])) ? $Busca_temp['emitida_bvt'] : ""; 
          $tmp_pos = (is_string($this->emitida_bvt)) ? strpos($this->emitida_bvt, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->emitida_bvt))
          {
              $this->emitida_bvt = substr($this->emitida_bvt, 0, $tmp_pos);
          }
          $this->bloqueio_dsc = (isset($Busca_temp['bloqueio_dsc'])) ? $Busca_temp['bloqueio_dsc'] : ""; 
          $tmp_pos = (is_string($this->bloqueio_dsc)) ? strpos($this->bloqueio_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloqueio_dsc))
          {
              $this->bloqueio_dsc = substr($this->bloqueio_dsc, 0, $tmp_pos);
          }
          $this->data_saida = (isset($Busca_temp['data_saida'])) ? $Busca_temp['data_saida'] : ""; 
          $tmp_pos = (is_string($this->data_saida)) ? strpos($this->data_saida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_saida))
          {
              $this->data_saida = substr($this->data_saida, 0, $tmp_pos);
          }
          $data_saida_2 = (isset($Busca_temp['data_saida_input_2'])) ? $Busca_temp['data_saida_input_2'] : ""; 
          $this->data_saida_2 = $data_saida_2; 
          $this->hora_saida = (isset($Busca_temp['hora_saida'])) ? $Busca_temp['hora_saida'] : ""; 
          $tmp_pos = (is_string($this->hora_saida)) ? strpos($this->hora_saida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hora_saida))
          {
              $this->hora_saida = substr($this->hora_saida, 0, $tmp_pos);
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
          $this->data_nota_gate = (isset($Busca_temp['data_nota_gate'])) ? $Busca_temp['data_nota_gate'] : ""; 
          $tmp_pos = (is_string($this->data_nota_gate)) ? strpos($this->data_nota_gate, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_nota_gate))
          {
              $this->data_nota_gate = substr($this->data_nota_gate, 0, $tmp_pos);
          }
          $data_nota_gate_2 = (isset($Busca_temp['data_nota_gate_input_2'])) ? $Busca_temp['data_nota_gate_input_2'] : ""; 
          $this->data_nota_gate_2 = $data_nota_gate_2; 
          $this->nota_gate = (isset($Busca_temp['nota_gate'])) ? $Busca_temp['nota_gate'] : ""; 
          $tmp_pos = (is_string($this->nota_gate)) ? strpos($this->nota_gate, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nota_gate))
          {
              $this->nota_gate = substr($this->nota_gate, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['contr_total_geral'] = "OK";
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepR2($evento,$vp_usuario,$vp_tipo,$vp_nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$ret = 'ADICIONA OK2';
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
					evento_id = ".$this->Db->qstr($evento)."
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
		if($vp_nivel == 'CONVIDADO') {
			$sqlj = "
			SELECT 
				aereos_rsvp.aereo_id_evento AS a_evento,
				aereos_rsvp.aereo_id_usuario AS a_usuario,
				usuarios_rsvp.usuario_nome AS usuario_nome,
				aereos_rsvp.aereo_cpf_particip AS a_cpf,
				CASE aereos_rsvp.aereo_status 
					WHEN 'Y' THEN 'CONFIRMADO'
					WHEN 'A' THEN 'ABERTO'
					WHEN 'P' THEN 'PENDENTE'
					WHEN 'N' THEN 'NÃO CONFIRMADO'
				END
				AS a_status,
				aereos_rsvp.aereo_direcao AS a_direcao,
				aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
				tbl_cia_aereas.cia_nome AS cia_aerea,
				aereos_rsvp.aereo_num_voo AS a_voo,
				CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
				CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
				aereos_rsvp.aereo_dt_saida AS a_dt_saida,
				aereos_rsvp.aereo_hr_saida AS a_hr_saida,
				aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
				aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
				aereos_rsvp.aereo_localizador AS a_localizador,
				aereos_rsvp.aereo_eticket AS a_etkt,				
				IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
				aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
				bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
				aereos_rsvp.aereo_modificado_em AS a_modificado_em,
				aereos_rsvp.aereo_ativo AS a_ativo,
				aereos_rsvp.nome_pax_gate AS a_pax_gate,
				aereos_rsvp.nota_gate AS a_nota_gate,
				aereos_rsvp.data_nota_gate AS a_dt_nota_gate			
			FROM
				aereos_rsvp
			INNER JOIN 	
				usuarios_rsvp
			ON	
				usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
			INNER JOIN 	
				acompanhantes_rsvp
			ON
				acompanhantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
			INNER JOIN
				tbl_cia_aereas
			ON
				tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
			INNER JOIN
				aeroporto AS orig				
			ON
				aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
			INNER JOIN
				aeroporto AS dest		
			ON		 
				aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
			LEFT JOIN
				bloqueio_aereo_rsvp	
			ON 
				aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
			WHERE
				aereos_rsvp.aereo_ativo =  ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
			AND
				aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
			AND
				aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
			ORDER BY
				aereos_rsvp.aereo_cpf_particip,
				aereos_rsvp.aereo_dthr_saida,
				aereos_rsvp.aereo_direcao			
			";
		} else {
			$sqlj = "
			SELECT 
				aereos_rsvp.aereo_id_evento AS a_evento,
				aereos_rsvp.aereo_id_usuario AS a_usuario,
				usuarios_rsvp.usuario_nome AS usuario_nome,
				aereos_rsvp.aereo_cpf_particip AS a_cpf,
				CASE aereos_rsvp.aereo_status 
					WHEN 'Y' THEN 'CONFIRMADO'
					WHEN 'A' THEN 'ABERTO'
					WHEN 'P' THEN 'PENDENTE'
					WHEN 'N' THEN 'NÃO CONFIRMADO'
				END
				AS a_status,
				aereos_rsvp.aereo_direcao AS a_direcao,
				aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
				tbl_cia_aereas.cia_nome AS cia_aerea,
				aereos_rsvp.aereo_num_voo AS a_voo,
				CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
				CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
				aereos_rsvp.aereo_dt_saida AS a_dt_saida,
				aereos_rsvp.aereo_hr_saida AS a_hr_saida,
				aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
				aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
				aereos_rsvp.aereo_localizador AS a_localizador,
				aereos_rsvp.aereo_eticket AS a_etkt,				
				IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
				aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
				bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
				aereos_rsvp.aereo_modificado_em AS a_modificado_em,
				aereos_rsvp.aereo_ativo AS a_ativo,
				aereos_rsvp.nome_pax_gate AS a_pax_gate,
				aereos_rsvp.nota_gate AS a_nota_gate,
				aereos_rsvp.data_nota_gate AS a_dt_nota_gate			
			FROM
				aereos_rsvp
			INNER JOIN 	
				usuarios_rsvp
			ON	
				usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
			INNER JOIN 	
				acompanhantes_rsvp
			ON
				acompanhantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
			INNER JOIN
				tbl_cia_aereas
			ON
				tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
			INNER JOIN
				aeroporto AS orig				
			ON
				aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
			INNER JOIN
				aeroporto AS dest		
			ON		 
				aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
			LEFT JOIN
				bloqueio_aereo_rsvp	
			ON 
				aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
			WHERE
				aereos_rsvp.aereo_ativo =  ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
			AND
				aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
			AND
				aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
			ORDER BY
				aereos_rsvp.aereo_cpf_particip,
				aereos_rsvp.aereo_dthr_saida,
				aereos_rsvp.aereo_direcao			
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
				$v_evento				= $this->rsj[$i][0]; 	
				$v_usuario				= $this->rsj[$i][1];		
				$v_usuario_nome			= $this->rsj[$i][2]; 	
				$v_cpf					= $this->rsj[$i][3]; 	
				$v_status				= $this->rsj[$i][4]; 	
				$v_direcao				= $this->rsj[$i][5]; 	
				$v_cod_cia_aerea		= $this->rsj[$i][6]; 	
				$v_cia_aerea			= $this->rsj[$i][7]; 	
				$v_voo					= $this->rsj[$i][8];		
				$v_origem				= $this->rsj[$i][9]; 	
				$v_destino				= $this->rsj[$i][10];	
				$v_dt_saida				= $this->rsj[$i][11];	
				$v_hr_saida				= $this->rsj[$i][12];	
				$v_dt_chegada			= $this->rsj[$i][13];	
				$v_hr_chegada			= $this->rsj[$i][14];	
				$v_localizador			= $this->rsj[$i][15];	
				$v_etkt					= $this->rsj[$i][16];	
				$v_emitida_bvt			= $this->rsj[$i][17];	
				$v_bloqueio				= $this->rsj[$i][18];	
				$v_dbloqueio			= $this->rsj[$i][19];	
				$v_modificado_em		= $this->rsj[$i][20];	
				$v_ativo				= $this->rsj[$i][21];	
				$v_pax_gate				= $this->rsj[$i][22];	
				$v_nota_gate			= $this->rsj[$i][23];	
				$v_dt_nota_gate			= $this->rsj[$i][24];	
				$v_tipoPessoa			= "ACOMPANHANTE";
				$sqlPes = "								
				SELECT						
					pessoa_cpf,
					pessoa_nome				
				FROM
					pessoas_rsvp
				WHERE
					pessoa_cpf = ".$this->Db->qstr($v_cpf)."
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
					$v_participante_nome = $this->rspes[0][1];
				} else {
					$v_participante_nome = "ERRO";				
				}													
				$reg_count = 1;	
				$sqlc = "						
				SELECT 
					aereopar_rsvp_r.id_evento, 
					aereopar_rsvp_r.participante_cpf,
					aereopar_rsvp_r.direcao,
					aereopar_rsvp_r.cod_cia_aerea,
					aereopar_rsvp_r.origem,
					aereopar_rsvp_r.voo,
					aereopar_rsvp_r.hora_saida,
					aereopar_rsvp_r.data_saida	
				FROM 
					aereopar_rsvp_r 
				WHERE 
					aereopar_rsvp_r.id_evento = ".$this->Db->qstr($v_evento)."
				AND 
					aereopar_rsvp_r.participante_cpf = ".$this->Db->qstr($v_cpf)."
				AND
					aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)."
				AND
					aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."
				AND
					aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)."
				AND
					aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)."
				AND	
					aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)."
				AND	
					aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)."
				AND
					aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				";	
				 
      $nm_select = $sqlc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsc = false;
          $this->rsc_erro = $this->Db->ErrorMsg();
      } 
	
				if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

				$reg_count = sizeof($this->rsc );	
				if ($reg_count == 0) {					
																	
					if($v_bloqueio <> '0') {
						
						$_usado_bloqueio = '1';
						$sqlbs="
						SELECT 
							bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
						FROM
							bloqueio_aereo_rsvp
						WHERE
							bloqueio_id = ".$this->Db->qstr($v_bloqueio)."
						AND
							bloq_evento_id = ".$this->Db->qstr($evento)."
						ORDER BY
							bloqueio_id,bloq_evento_id
						";							
						 
      $nm_select = $sqlbs; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsbs = false;
          $this->rsbs_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($this->rsbs[0][0])) {	
							$_sentido 	= $this->rsbs[0][2];									
							$_total_bloq = $this->rsbs[0][3];									
						}										
					} else {
						$_sentido	= '';															
						$_total_bloq = '0';								
						$_usado_bloqueio = '0';
					}					
					$sqlins = "
						SELECT 
							COUNT(p_cpf) as qtde
						FROM 
							aereopar_rsvp_r
						WHERE 
							participante_cpf = ".$this->Db->qstr($v_cpf)." 
						AND 
							id_evento = ".$this->Db->qstr($v_evento)."									
						AND
							direcao = ".$this->Db->qstr($v_direcao)."
						AND
							cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."
						AND
							origem = ".$this->Db->qstr($v_origem)."
						AND
							voo = ".$this->Db->qstr($v_voo)."
						AND	
							hora_saida = ".$this->Db->qstr($v_hr_saida)."
						AND	
							data_saida = ".$this->Db->qstr($v_dt_saida)."	
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
						$sqli2 = "					
						INSERT INTO
							aereopar_rsvp_r  
							(id_evento,
							id_usuario,
							usuario_nome,
							participante_cpf,
							participante_nome,
							satus,
							direcao,
							cod_cia_aerea,
							cia_aerea,
							voo,
							origem,
							destino,
							data_saida,
							hora_saida,
							data_chegada,
							hora_chegada,
							localizador,
							etkt,	
							emitida_bvt,
							bloqueio,
							bloqueio_dsc,
							modificado_em,
							ativo,
							pax_gate,
							nota_gate,
							data_nota_gate,							
							id_usuario_relato,
							tipo_pessoa,
							usado_bloqueio,
							total_bloqueio,
							direcao_bloqueio)							
						VALUES
							(".$this->Db->qstr($v_evento).", 				 
							".$this->Db->qstr($v_usuario).",               
							".$this->Db->qstr($v_usuario_nome).",         
							".$this->Db->qstr($v_cpf).",                
							".$this->Db->qstr($v_participante_nome).",     
							".$this->Db->qstr($v_status).",                       
							".$this->Db->qstr($v_direcao).",               
							".$this->Db->qstr($v_cod_cia_aerea).",         
							".$this->Db->qstr($v_cia_aerea).",             
							".$this->Db->qstr($v_voo).",                   
							".$this->Db->qstr($v_origem).",               
							".$this->Db->qstr($v_destino).",               
							".$this->Db->qstr($v_dt_saida).",              
							".$this->Db->qstr($v_hr_saida).",              
							".$this->Db->qstr($v_dt_chegada).",            
							".$this->Db->qstr($v_hr_chegada).",           
							".$this->Db->qstr($v_localizador).",           
							".$this->Db->qstr($v_etkt).",                  
							".$this->Db->qstr($v_emitida_bvt).",           
							".$this->Db->qstr($v_bloqueio).",              
							".$this->Db->qstr($v_dbloqueio).",             
							".$this->Db->qstr($v_modificado_em).",         
							".$this->Db->qstr($v_ativo).",                 
							".$this->Db->qstr($v_pax_gate).",              
							".$this->Db->qstr($v_nota_gate).",             
							".$this->Db->qstr($v_dt_nota_gate).",         
							".$this->Db->qstr($vp_usuario).",
							".$this->Db->qstr($v_tipoPessoa).",
							".$this->Db->qstr($_usado_bloqueio).",
							".$this->Db->qstr($_total_bloq).",
							".$this->Db->qstr($_sentido).")						
						";	
						
     $nm_select = $sqli2; 
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
			}
			$ret = 'ADICIONA OK2';	
		} else {
			$ret = 'ADICIONA ERRO2';	
		}				
		return $ret;
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepRelAereo($evento,$vp_usuario,$vp_tipo,$vp_nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		
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
					evento_id = ".$this->Db->qstr($evento)."
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
	
		if ($vp_tipo == 'P') {
			$sqld="
			DELETE FROM 
				aereopar_rsvp_r 
			WHERE   
				id_evento = ".$this->Db->qstr($evento)."
			AND 
				id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
			";	
		}
		
		$sql="
		SELECT
    		id_evento,
  			id_usuario_relato
		FROM
   			aereopar_rsvp_r 
		WHERE   
			id_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($$vp_usuario)."
		ORDER BY 
			id_evento,
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
	
		$reg_subs = sizeof($this->rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {						
			if($vp_nivel == 'CONVIDADO') {
				$sqlj = "
				SELECT 
					aereos_rsvp.aereo_id_evento AS a_evento,
					aereos_rsvp.aereo_id_usuario AS a_usuario,
					usuarios_rsvp.usuario_nome AS usuario_nome,
					aereos_rsvp.aereo_cpf_particip AS a_cpf,
					participantes_rsvp.nome_pessoa AS participante_nome, 
					CASE aereos_rsvp.aereo_status 
						WHEN 'Y' THEN 'CONFIRMADO'
						WHEN 'A' THEN 'ABERTO'
						WHEN 'P' THEN 'PENDENTE'
						WHEN 'N' THEN 'NÃO CONFIRMADO'
					END
					AS a_status,
					aereos_rsvp.aereo_direcao AS a_direcao,
					aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
					tbl_cia_aereas.cia_nome AS cia_aerea,
					aereos_rsvp.aereo_num_voo AS a_voo,
					CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
					CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
					aereos_rsvp.aereo_dt_saida AS a_dt_saida,
					aereos_rsvp.aereo_hr_saida AS a_hr_saida,
					aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
					aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
					aereos_rsvp.aereo_localizador AS a_localizador,
					aereos_rsvp.aereo_eticket AS a_etkt,				
					IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
					aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
					bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
					aereos_rsvp.aereo_modificado_em AS a_modificado_em,
					aereos_rsvp.aereo_ativo AS a_ativo,
					aereos_rsvp.nome_pax_gate AS a_pax_gate,
					aereos_rsvp.nota_gate AS a_nota_gate,
					aereos_rsvp.data_nota_gate AS a_dt_nota_gate,
					participantes_rsvp.part_id_evento_publico,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					aereos_rsvp
				INNER JOIN 	
					usuarios_rsvp
				ON	
					usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
				INNER JOIN 	
					participantes_rsvp
				ON
					participantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
				INNER JOIN
					tbl_cia_aereas
				ON
					tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
				INNER JOIN
					aeroporto AS orig				
				ON
					aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
				INNER JOIN
					aeroporto AS dest		
				ON		 
					aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
				LEFT JOIN
					bloqueio_aereo_rsvp	
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
				WHERE
					aereos_rsvp.aereo_ativo = ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
				AND
					aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
				AND
					aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
				AND			  
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY
					aereos_rsvp.aereo_cpf_particip,
					aereos_rsvp.aereo_dthr_saida,
					aereos_rsvp.aereo_direcao				
				";
			} else {
				$sqlj = "
				SELECT 
					aereos_rsvp.aereo_id_evento AS a_evento,
					aereos_rsvp.aereo_id_usuario AS a_usuario,
					usuarios_rsvp.usuario_nome AS usuario_nome,
					aereos_rsvp.aereo_cpf_particip AS a_cpf,
					participantes_rsvp.nome_pessoa AS participante_nome, 
					CASE aereos_rsvp.aereo_status 
						WHEN 'Y' THEN 'CONFIRMADO'
						WHEN 'A' THEN 'ABERTO'
						WHEN 'P' THEN 'PENDENTE'
						WHEN 'N' THEN 'NÃO CONFIRMADO'
					END
					AS a_status,
					aereos_rsvp.aereo_direcao AS a_direcao,
					aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
					tbl_cia_aereas.cia_nome AS cia_aerea,
					aereos_rsvp.aereo_num_voo AS a_voo,
					CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
					CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
					aereos_rsvp.aereo_dt_saida AS a_dt_saida,
					aereos_rsvp.aereo_hr_saida AS a_hr_saida,
					aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
					aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
					aereos_rsvp.aereo_localizador AS a_localizador,
					aereos_rsvp.aereo_eticket AS a_etkt,				
					IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
					aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
					bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
					aereos_rsvp.aereo_modificado_em AS a_modificado_em,
					aereos_rsvp.aereo_ativo AS a_ativo,
					aereos_rsvp.nome_pax_gate AS a_pax_gate,
					aereos_rsvp.nota_gate AS a_nota_gate,
					aereos_rsvp.data_nota_gate AS a_dt_nota_gate,
					participantes_rsvp.part_id_evento_publico,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					aereos_rsvp
				INNER JOIN 	
					usuarios_rsvp
				ON	
					usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
				INNER JOIN 	
					participantes_rsvp
				ON
					participantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
				INNER JOIN
					tbl_cia_aereas
				ON
					tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
				INNER JOIN
					aeroporto AS orig				
				ON
					aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
				INNER JOIN
					aeroporto AS dest		
				ON		 
					aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
				LEFT JOIN
					bloqueio_aereo_rsvp	
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
				WHERE
					aereos_rsvp.aereo_ativo = ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
				AND
					aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
				AND
					aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
				AND			  
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				ORDER BY
					aereos_rsvp.aereo_cpf_particip,
					aereos_rsvp.aereo_dthr_saida,
					aereos_rsvp.aereo_direcao				
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
					$v_evento				= $this->rsj[$i][0]; 	
					$v_usuario				= $this->rsj[$i][1];		
					$v_usuario_nome			= $this->rsj[$i][2]; 	
					$v_cpf					= $this->rsj[$i][3]; 	
					$v_participante_nome	= $this->rsj[$i][4]; 	
					$v_status				= $this->rsj[$i][5]; 	
					$v_direcao				= $this->rsj[$i][6]; 	
					$v_cod_cia_aerea		= $this->rsj[$i][7]; 	
					$v_cia_aerea			= $this->rsj[$i][8]; 	
					$v_voo					= $this->rsj[$i][9];		
					$v_origem				= $this->rsj[$i][10]; 	
					$v_destino				= $this->rsj[$i][11];	
					$v_dt_saida				= $this->rsj[$i][12];	
					$v_hr_saida				= $this->rsj[$i][13];	
					$v_dt_chegada			= $this->rsj[$i][14];	
					$v_hr_chegada			= $this->rsj[$i][15];	
					$v_localizador			= $this->rsj[$i][16];	
					$v_etkt					= $this->rsj[$i][17];	
					$v_emitida_bvt			= $this->rsj[$i][18];	
					$v_bloqueio				= $this->rsj[$i][19];	
					$v_dbloqueio			= $this->rsj[$i][20];	
					$v_modificado_em		= $this->rsj[$i][21];	
					$v_ativo				= $this->rsj[$i][22];	
					$v_pax_gate				= $this->rsj[$i][23];	
					$v_nota_gate			= $this->rsj[$i][24];	
					$v_dt_nota_gate			= $this->rsj[$i][25];	
					
					$v_publico_id			= $this->rsj[$i][26];							
					
					$v_tipoPessoa			= "PARTICIPANTE";
					$reg_count = 1;	
					$sqlc = "						
					SELECT 
						aereopar_rsvp_r.id_evento, 
						aereopar_rsvp_r.participante_cpf,
						aereopar_rsvp_r.direcao,
						aereopar_rsvp_r.cod_cia_aerea,
						aereopar_rsvp_r.origem,
						aereopar_rsvp_r.voo,
						aereopar_rsvp_r.hora_saida,
						aereopar_rsvp_r.data_saida	
					FROM 
						aereopar_rsvp_r 
					WHERE 
						aereopar_rsvp_r.id_evento = ".$this->Db->qstr($v_evento)." 
					AND 
						aereopar_rsvp_r.participante_cpf = ".$this->Db->qstr($v_cpf)." 
					AND
						aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)." 
					AND
						aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)." 
					AND
						aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)." 
					AND
						aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)." 
					AND	
						aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)." 
					AND	
						aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)." 
					AND
						aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
					";							
					 
      $nm_select = $sqlc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsc = false;
          $this->rsc_erro = $this->Db->ErrorMsg();
      } 
	
					if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

					$reg_count = sizeof($this->rsc );							
					if ($reg_count == 0) {
																		
						if($v_bloqueio <> '0') {
							
							$_usado_bloqueio = '1';
							$sqlbs="
							SELECT 
								bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
							FROM
								bloqueio_aereo_rsvp
							WHERE
								bloqueio_id = ".$this->Db->qstr($v_bloqueio)." 
							AND
								bloq_evento_id = ".$this->Db->qstr($evento)." 
							ORDER BY
								bloqueio_id,bloq_evento_id
							";							
							 
      $nm_select = $sqlbs; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsbs = false;
          $this->rsbs_erro = $this->Db->ErrorMsg();
      } 
	
							if (isset($this->rsbs[0][0])) {	
								$_sentido 	= $this->rsbs[0][2];									
								$_total_bloq = $this->rsbs[0][3];									
							}		
								
						} else {
							$_sentido	= '';															
							$_total_bloq = '0';								
							$_usado_bloqueio = '0';
						}		
						
						$sqlpa = "
							SELECT
								part_cpf,
								part_id_evento_publico
							FROM
								participantes_rsvp	
							WHERE
								part_cpf = ".$this->Db->qstr($v_cpf)."
							AND
								part_id_evento = ".$this->Db->qstr($v_evento)."
						";	
						 
      $nm_select = $sqlpa; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspa = false;
          $this->rspa_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($this->rspa[0][0])) {	
							$v_publico_id = $this->rspa[0][1];
						}	
						$sqlpub ="
							SELECT
								publico_id,
								publico_nome
							FROM 
								publico_rsvp
							WHERE
								publico_id = ".$this->Db->qstr($v_publico_id)."
						";
						 
      $nm_select = $sqlpub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspb = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspb[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspb = false;
          $this->rspb_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($this->rspb[0][0])) {	
							$v_publico_dsc = $this->rspb[0][1];									
						} else {
							$v_publico_dsc = '';
						}	
						$sqlins = "
							SELECT 
								COUNT(p_cpf) as qtde
							FROM 
								aereopar_rsvp_r
							WHERE 
								participante_cpf = ".$this->Db->qstr($v_cpf)." 
							AND 
								id_evento = ".$this->Db->qstr($v_evento)."  
							AND
								aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)." 
							AND
								aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."  
							AND
								aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)."  
							AND
								aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)." 
							AND	
								aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)." 
							AND	
								aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)." 
							AND
								aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
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
								aereopar_rsvp_r  
								(id_evento,
								id_usuario,
								usuario_nome,
								participante_cpf,
								participante_nome,
								satus,
								direcao,
								cod_cia_aerea,
								cia_aerea,
								voo,
								origem,
								destino,
								data_saida,
								hora_saida,
								data_chegada,
								hora_chegada,
								localizador,
								etkt,	
								emitida_bvt,
								bloqueio,
								bloqueio_dsc,
								modificado_em,
								ativo,
								pax_gate,
								nota_gate,
								data_nota_gate,							
								id_usuario_relato,
								tipo_pessoa,
								usado_bloqueio,
								total_bloqueio,
								publico,
								direcao_bloqueio)	
							VALUES
								(".$this->Db->qstr($v_evento).", 				 
								".$this->Db->qstr($v_usuario).",               
								".$this->Db->qstr($v_usuario_nome).",         
								".$this->Db->qstr($v_cpf).",                
								".$this->Db->qstr($v_participante_nome).",     
								".$this->Db->qstr($v_status).",                       
								".$this->Db->qstr($v_direcao).",               
								".$this->Db->qstr($v_cod_cia_aerea).",         
								".$this->Db->qstr($v_cia_aerea).",             
								".$this->Db->qstr($v_voo).",                   
								".$this->Db->qstr($v_origem).",               
								".$this->Db->qstr($v_destino).",               
								".$this->Db->qstr($v_dt_saida).",              
								".$this->Db->qstr($v_hr_saida).",              
								".$this->Db->qstr($v_dt_chegada).",            
								".$this->Db->qstr($v_hr_chegada).",           
								".$this->Db->qstr($v_localizador).",           
								".$this->Db->qstr($v_etkt).",                  
								".$this->Db->qstr($v_emitida_bvt).",           
								".$this->Db->qstr($v_bloqueio).",              
								".$this->Db->qstr($v_dbloqueio).",             
								".$this->Db->qstr($v_modificado_em).",         
								".$this->Db->qstr($v_ativo).",                 
								".$this->Db->qstr($v_pax_gate).",              
								".$this->Db->qstr($v_nota_gate).",             
								".$this->Db->qstr($v_dt_nota_gate).",         
								".$this->Db->qstr($vp_usuario).",																
								".$this->Db->qstr($v_tipoPessoa).",
								".$this->Db->qstr($_usado_bloqueio).",
								".$this->Db->qstr($_total_bloq).",
								".$this->Db->qstr($v_publico_dsc).",
								".$this->Db->qstr($_sentido).")	       							
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
					}
					$ret = 'ADICIONA OK';	
				} else {
					$ret = 'ADICIONA ERRO';	
				}			
		}
		return $ret;
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepRelRsvp2($evento,$usuario) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}

}

?>
