<?php

class grid_trlocal_rsvp_r_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_trlocal_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_trlocal_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['campos_busca'];
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
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->ddd_celular = (isset($Busca_temp['ddd_celular'])) ? $Busca_temp['ddd_celular'] : ""; 
          $tmp_pos = (is_string($this->ddd_celular)) ? strpos($this->ddd_celular, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ddd_celular))
          {
              $this->ddd_celular = substr($this->ddd_celular, 0, $tmp_pos);
          }
          $this->data_nascimento = (isset($Busca_temp['data_nascimento'])) ? $Busca_temp['data_nascimento'] : ""; 
          $tmp_pos = (is_string($this->data_nascimento)) ? strpos($this->data_nascimento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_nascimento))
          {
              $this->data_nascimento = substr($this->data_nascimento, 0, $tmp_pos);
          }
          $data_nascimento_2 = (isset($Busca_temp['data_nascimento_input_2'])) ? $Busca_temp['data_nascimento_input_2'] : ""; 
          $this->data_nascimento_2 = $data_nascimento_2; 
          $this->status = (isset($Busca_temp['status'])) ? $Busca_temp['status'] : ""; 
          $tmp_pos = (is_string($this->status)) ? strpos($this->status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->status))
          {
              $this->status = substr($this->status, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->origem_ida = (isset($Busca_temp['origem_ida'])) ? $Busca_temp['origem_ida'] : ""; 
          $tmp_pos = (is_string($this->origem_ida)) ? strpos($this->origem_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->origem_ida))
          {
              $this->origem_ida = substr($this->origem_ida, 0, $tmp_pos);
          }
          $this->destino_ida = (isset($Busca_temp['destino_ida'])) ? $Busca_temp['destino_ida'] : ""; 
          $tmp_pos = (is_string($this->destino_ida)) ? strpos($this->destino_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->destino_ida))
          {
              $this->destino_ida = substr($this->destino_ida, 0, $tmp_pos);
          }
          $this->data_ida = (isset($Busca_temp['data_ida'])) ? $Busca_temp['data_ida'] : ""; 
          $tmp_pos = (is_string($this->data_ida)) ? strpos($this->data_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_ida))
          {
              $this->data_ida = substr($this->data_ida, 0, $tmp_pos);
          }
          $data_ida_2 = (isset($Busca_temp['data_ida_input_2'])) ? $Busca_temp['data_ida_input_2'] : ""; 
          $this->data_ida_2 = $data_ida_2; 
          $this->horario_ida = (isset($Busca_temp['horario_ida'])) ? $Busca_temp['horario_ida'] : ""; 
          $tmp_pos = (is_string($this->horario_ida)) ? strpos($this->horario_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->horario_ida))
          {
              $this->horario_ida = substr($this->horario_ida, 0, $tmp_pos);
          }
          $this->origem_volta = (isset($Busca_temp['origem_volta'])) ? $Busca_temp['origem_volta'] : ""; 
          $tmp_pos = (is_string($this->origem_volta)) ? strpos($this->origem_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->origem_volta))
          {
              $this->origem_volta = substr($this->origem_volta, 0, $tmp_pos);
          }
          $this->destino_volta = (isset($Busca_temp['destino_volta'])) ? $Busca_temp['destino_volta'] : ""; 
          $tmp_pos = (is_string($this->destino_volta)) ? strpos($this->destino_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->destino_volta))
          {
              $this->destino_volta = substr($this->destino_volta, 0, $tmp_pos);
          }
          $this->data_volta = (isset($Busca_temp['data_volta'])) ? $Busca_temp['data_volta'] : ""; 
          $tmp_pos = (is_string($this->data_volta)) ? strpos($this->data_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_volta))
          {
              $this->data_volta = substr($this->data_volta, 0, $tmp_pos);
          }
          $data_volta_2 = (isset($Busca_temp['data_volta_input_2'])) ? $Busca_temp['data_volta_input_2'] : ""; 
          $this->data_volta_2 = $data_volta_2; 
          $this->horario_volta = (isset($Busca_temp['horario_volta'])) ? $Busca_temp['horario_volta'] : ""; 
          $tmp_pos = (is_string($this->horario_volta)) ? strpos($this->horario_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->horario_volta))
          {
              $this->horario_volta = substr($this->horario_volta, 0, $tmp_pos);
          }
          $this->participante = (isset($Busca_temp['participante'])) ? $Busca_temp['participante'] : ""; 
          $tmp_pos = (is_string($this->participante)) ? strpos($this->participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante))
          {
              $this->participante = substr($this->participante, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trlocal_rsvp_r']['contr_total_geral'] = "OK";
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
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}


function PrepReloc($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;
		$ret = 'ADICIONA ERRO';			
		$valor_y = 'Y';
		$valor_p = 'P';
		$valor_l = 'L';
	
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
				trlocal_rsvp_r
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
					participantes_rsvp.part_id_evento_regional AS p_regional,     
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                     
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                     
					transfer_rsvp.tra_origem_ida_local AS origem_ida,  
					transfer_rsvp.tra_destino_ida_local AS destino_ida,                      
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                 
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                 
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                          
					transfer_rsvp.tra_tipo AS tipo_transfer,		                   
					transfer_rsvp.tra_status AS t_status,                         
					transfer_rsvp.tra_ativo AS ativo,                             
					participantes_rsvp.part_cod_usuario AS usuario,               
					transfer_rsvp.tra_observacao AS obs				
				FROM
					transfer_rsvp
				RIGHT JOIN 
					participantes_rsvp	
				ON 	
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
				AND
					participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."				
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)." 
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 
				AND	
					participantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				AND
					transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
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
					participantes_rsvp.part_id_evento_regional AS p_regional,     
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                     
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                     
					transfer_rsvp.tra_origem_ida_local AS origem_ida,  
					transfer_rsvp.tra_destino_ida_local AS destino_ida,                      
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                 
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                 
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                          
					transfer_rsvp.tra_tipo AS tipo_transfer,		                   
					transfer_rsvp.tra_status AS t_status,                         
					transfer_rsvp.tra_ativo AS ativo,                             
					participantes_rsvp.part_cod_usuario AS usuario,               
					transfer_rsvp.tra_observacao AS obs,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				RIGHT JOIN 
					participantes_rsvp	
				ON 	
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
				AND
					participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."				
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)." 
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 
				AND	
					participantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				AND
					transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
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
					acompanhantes_rsvp.part_dt_nasc AS dt_nasc,		                          
					acompanhantes_rsvp.part_rg AS rg,                             
					transfer_rsvp.tra_cpf_particip AS cpf,                       
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,  
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01,         
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,      
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,    
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                    
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                    
					transfer_rsvp.tra_origem_ida_local AS origem_ida,                     
					transfer_rsvp.tra_destino_ida_local AS destino_ida,				       			
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                         
					transfer_rsvp.tra_tipo AS tipo_transfer,					 				                  
					transfer_rsvp.tra_status AS t_status,                        
					transfer_rsvp.tra_ativo AS ativo,                            
					acompanhantes_rsvp.part_cod_usuario AS usuario,              
					transfer_rsvp.tra_observacao AS obs	   														     
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					acompanhantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)." 
				AND
					acompanhantes_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."
				AND
					acompanhantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)." 	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 
				AND
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf	
				ORDER BY				 
					transfer_rsvp.tra_cpf_particip			
				";
			} else {
				$sqlMestre = "		
				SELECT							
					acompanhantes_rsvp.part_id_evento AS evt,				                      
					acompanhantes_rsvp.part_dt_nasc AS dt_nasc,		                          
					acompanhantes_rsvp.part_rg AS rg,                             
					transfer_rsvp.tra_cpf_particip AS cpf,                       
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,  
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01,         
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,      
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,    
					transfer_rsvp.tra_dt_ida_local AS dt_ida,                    
					transfer_rsvp.tra_hr_ida_local AS hr_ida,                    
					transfer_rsvp.tra_origem_ida_local AS origem_ida,                     
					transfer_rsvp.tra_destino_ida_local AS destino_ida,				       			
					transfer_rsvp.tra_dt_volta_local AS dt_volta,                
					transfer_rsvp.tra_hr_volta_local AS hr_volta,                
					transfer_rsvp.tra_origem_volta_local AS origem_vola,                 
					transfer_rsvp.tra_destino_volta_local AS destino_volta,	          
					transfer_rsvp.tra_id_hotel AS Hotel,                         
					transfer_rsvp.tra_tipo AS tipo_transfer,					 				                  
					transfer_rsvp.tra_status AS t_status,                        
					transfer_rsvp.tra_ativo AS ativo,                            
					acompanhantes_rsvp.part_cod_usuario AS usuario,              
					transfer_rsvp.tra_observacao AS obs,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					acompanhantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)." 
				AND
					acompanhantes_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."
				AND
					acompanhantes_rsvp.part_transfer = ".$this->Db->qstr($valor_y)." 
				WHERE
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)." 	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_l)." 	
				AND
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY				 
					transfer_rsvp.tra_cpf_particip			
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
					$w_id_evento			= $this->rsm[$i][0];          
					$w_participante			= $this->rsm[$i][1];       
					$w_dt_nasc		        = $this->rsm[$i][2];	    
					$w_rg                   = $this->rsm[$i][3]; 
					$w_cpf_particip         = $this->rsm[$i][4]; 
					$w_ddd_celular_01       = $this->rsm[$i][5]; 
					$w_celeular_01          = $this->rsm[$i][6]; 
					$w_id_evento_publico    = $this->rsm[$i][7]; 
					$w_evento_regional      = $this->rsm[$i][8]; 
					$w_dt_ida_local         = $this->rsm[$i][9]; 
					$w_hr_ida_local         = $this->rsm[$i][10];			
					$w_origem_ida 			= $this->rsm[$i][11];       
					$w_destino_ida 			= $this->rsm[$i][12];      
					$w_dt_volta_local       = $this->rsm[$i][13];
					$w_hr_volta_local       = $this->rsm[$i][14];
					$w_origem_volta 		= $this->rsm[$i][15];      
					$w_destino_volta 		= $this->rsm[$i][16];     
					$w_id_hotel             = $this->rsm[$i][17];
					$w_tipo_transfer		= $this->rsm[$i][18];      
					$w_status               = $this->rsm[$i][19];
					$w_ativo                = $this->rsm[$i][20];
					$w_observacao           = $this->rsm[$i][22];														
					$w_tipo_pessoa  = "PARTICIPANTE";		
					$w_id_usuario_relato = $vp_usuario;
				} else {
					$w_id_evento			= $this->rsm[$i][0];          					
					$w_dt_nasc		        = $this->rsm[$i][1];	    
					$w_rg                   = $this->rsm[$i][2]; 
					$w_cpf_particip         = $this->rsm[$i][3]; 
					$w_ddd_celular_01       = $this->rsm[$i][4]; 
					$w_celeular_01          = $this->rsm[$i][5]; 
					$w_id_evento_publico    = $this->rsm[$i][6]; 
					$w_evento_regional      = $this->rsm[$i][7]; 
					$w_dt_ida_local         = $this->rsm[$i][8]; 
					$w_hr_ida_local         = $this->rsm[$i][9];			
					$w_origem_ida 			= $this->rsm[$i][10];       
					$w_destino_ida 			= $this->rsm[$i][11];      
					$w_dt_volta_local       = $this->rsm[$i][12];
					$w_hr_volta_local       = $this->rsm[$i][13];
					$w_origem_volta 		= $this->rsm[$i][14];      
					$w_destino_volta 		= $this->rsm[$i][15];     
					$w_id_hotel             = $this->rsm[$i][16];
					$w_tipo_transfer		= $this->rsm[$i][17];      
					$w_status               = $this->rsm[$i][18];
					$w_ativo                = $this->rsm[$i][19];
					$w_observacao           = $this->rsm[$i][21];		
					$w_tipo_pessoa  = "ACOMPANHANTE";
					$w_id_usuario_relato = $vp_usuario;
				}					
				if ($w_id_evento_publico <> '0') {
					$sqlPub = "			
					SELECT
						publico_id,
						publico_nome
					FROM
						publico_rsvp
					WHERE
						publico_id = ".$this->Db->qstr($w_id_evento_publico)."
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
				if ($w_evento_regional  <> '0') {
					$sqlReg = "								
					SELECT
						regional_id,
						regional_dsc
					FROM
						tbl_regionais
					WHERE
						regional_id = ".$this->Db->qstr($w_evento_regional)."
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
				if ($w_id_hotel <> '0') {
					$sqlHot = "								
					SELECT
						hotel_id,
						hotel_fantasia
					FROM
						tbl_hoteis
					WHERE
						hotel_id = ".$this->Db->qstr($w_id_hotel)."
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
						pessoa_cpf = ".$this->Db->qstr($w_cpf_particip)."
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
						trlocal_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($w_cpf_particip)." 
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
						trlocal_rsvp_r
						(id_evento,			
						participante,		
						data_nascimento,		
						rg,					
						cpf,					
						ddd_celular,			
						celular,				
						publico,				
						regional,			
						data_ida,			
						horario_ida,			
						origem_ida,			
						destino_ida,			
						data_volta,			
						horario_volta,		
						origem_volta,		
						destino_volta,		
						hotel,				
						tipo_pessoa,			
						status,				
						ativo,				
						id_usuario_relato,	
						observacoes,								
						usuario_relato_dsc,	
						publico_dsc,			
						regional_dsc,		
						hotel_dsc,			
						tipo_transfer,
						evento_dsc)		
					VALUES
						(".$this->Db->qstr($w_id_evento).", 		
						".$this->Db->qstr($w_participante).", 	
						".$this->Db->qstr($w_dt_nasc).", 		    
						".$this->Db->qstr($w_rg).",                
						".$this->Db->qstr($w_cpf_particip).",      
						".$this->Db->qstr($w_ddd_celular_01).",    
						".$this->Db->qstr($w_celeular_01).",       
						".$this->Db->qstr($w_id_evento_publico).", 
						".$this->Db->qstr($w_evento_regional).",   
						".$this->Db->qstr($w_dt_ida_local).",     
						".$this->Db->qstr($w_hr_ida_local).",      
						".$this->Db->qstr($w_origem_ida).",        
						".$this->Db->qstr($w_destino_ida).",       
						".$this->Db->qstr($w_dt_volta_local).",    
						".$this->Db->qstr($w_hr_volta_local).",    
						".$this->Db->qstr($w_origem_volta).",  	
						".$this->Db->qstr($w_destino_volta).",  	
						".$this->Db->qstr($w_id_hotel).",          
						".$this->Db->qstr($w_tipo_pessoa).",       
						".$this->Db->qstr($w_status).",            
						".$this->Db->qstr($w_ativo).",             
						".$this->Db->qstr($w_id_usuario_relato).", 
						".$this->Db->qstr($w_observacao).",        					 
						".$this->Db->qstr($w_usurelDsc).", 
						".$this->Db->qstr($w_publicoDsc).",  
						".$this->Db->qstr($w_regionalDsc).", 
						".$this->Db->qstr($w_hotelDsc).",  
						".$this->Db->qstr($w_tipo_transfer).",
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
								
				} else {
					$sqlupd="
						UPDATE 
							trlocal_rsvp_r
						SET 
							id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
						WHERE 
							id_evento = ".$this->Db->qstr($vp_evento)."
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
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trlocal_rsvp_r']['contr_erro'] = 'off';
}

}

?>
