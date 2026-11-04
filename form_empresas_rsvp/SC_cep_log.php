<?php
$_SESSION['scriptcase']['nm_charset_cep'] = "ISO-8859-1";
if (isset($_SESSION['scriptcase']['charset']) && !empty($_SESSION['scriptcase']['charset']))
{
    $_SESSION['scriptcase']['nm_charset_cep'] = $_SESSION['scriptcase']['charset'];
}
ini_set('default_charset', $_SESSION['scriptcase']['nm_charset_cep']);
include_once("../_lib/lib/php/nm_utf8.php");
?><!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
    <TITLE><?php echo $title; ?></TITLE>
    <META http-equiv="Content-Type"
          content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>"/>
    <?php
    if ((isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile']) || (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])) {
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="../_lib/lib/css/nm_export_mobile.css"/>
        <?php
    }
    ?>
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?> "/>
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>"/>
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab'] ?>"/>
    <link rel="stylesheet" type="text/css"
          href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab_dir'] ?>"/>
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>"/>
    <link rel="stylesheet" type="text/css"
          href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>"/>
    <?php
    if (isset($_SESSION['scriptcase']['str_google_fonts']) && !empty($_SESSION['scriptcase']['str_google_fonts'])) {
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['str_google_fonts']; ?>"/>
        <?php
    }
    ?>
    <link rel="stylesheet" type="text/css"
          href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/css/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo $_SESSION['sc_session']['path_third'] ?>/font-awesome/6/css/all.min.css"/>
</HEAD>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
    CEP_form_loc();
?>
 </SCRIPT>
<script Language="JavaScript">
function CriticaCampos()
{
  if (document.Geral.UF.value == "")
  {
    alert("Selecione um Estado (UF) !!");
    document.Geral.UF.focus();
    return (false);
  }
  if (document.Geral.Localidade.value == "")
  {
    alert("Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc) !!");
    document.Geral.Localidade.focus();
    return (false);
  }
  else
  {
   var Branco = " ";
   var Posic, Carac;
   var Temp = document.Geral.Localidade.value.length;
   var Cont = 0;
   for (var i=0; i < Temp; i++)
   {
   Carac =  document.Geral.Localidade.value.charAt (i);
   Posic  = Branco.indexOf (Carac);
   if (Posic == -1)
      Cont++;
   }
   if (Cont <= 0)
   {
        alert("Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc) !!");
        document.Geral.Localidade.focus();
        return (false);
   }
  }
  if (document.Geral.Logradouro.value == "")
  {
    alert('<?php echo sc_convert_encoding("Informe o nome da avenida, alameda, beco, passagem, pra�a, rua, travessa etc. N�o informe o n�mero da casa/lote/apartamento.", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
    document.Geral.Logradouro.focus();
    return (false);
  }
   var Branco = " ";
   var Posic, Carac;
   var Temp = document.Geral.Logradouro.value.length;
   var Cont = 0;
   for (var i=0; i < Temp; i++)
   {
   Carac =  document.Geral.Logradouro.value.charAt (i);
   Posic  = Branco.indexOf (Carac);
   if (Posic == -1)
      Cont++;
   }
   if (Cont <= 0)
   {
        alert('<?php echo sc_convert_encoding("Informe o nome da avenida, alameda, beco, passagem, pra�a, rua, travessa etc. N�o informe o n�mero da casa/lote/apartamento.", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
        document.Geral.Logradouro.focus();
        return (false);
   }
   else
   {
       if (Cont <= 2)
       {
/*
          if (document.Geral.Opcao[2].checked)
          {
             alert('<?php echo sc_convert_encoding("Na op��o COME�ANDO POR, informe no m�nimo 3 caracteres !!", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
             document.Geral.Logradouro.focus();
             return (false);
          }
          else
*/
             if (document.Geral.Opcao[0].checked)
             {
                alert('<?php echo sc_convert_encoding("Na op��o CONTENHA, informe no m�nimo 3 caracteres !!", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
                document.Geral.Logradouro.focus();
                return (false);
             }
             else
                if (document.Geral.Opcao[3].checked)
                {
                   alert('<?php echo sc_convert_encoding("Na op��o TERMINADO EM, informe no m�nimo 3 caracteres !!", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
                   document.Geral.Logradouro.focus();
                   return (false);
                }
       }
  }
}
</script>
<script Language="JavaScript">
 function RetiraAcentos(Campo)
 {
   return (Campo);
}
function nm_fecha_janela()
 {
     if (self.parent && self.parent.$)
     {
         self.parent.tb_remove();
     }
     else
     {
         window.close();
     }
 }
</script>
<script Language="JavaScript">
 function AjudaLocalidade()
 {
//   DocRemote = window.open ('http://www.correios.com.br/servicos/cep/AjudaLocalidade.cfm','Localidade','scrollbars,resizable,width=410,height=180');
     alert("Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc) !!");
     document.Geral.Localidade.focus();
 }
</script>

<script Language="JavaScript">
 function AjudaLogradouro()
 {
//   DocRemote = window.open ('http://www.correios.com.br/servicos/cep/AjudaLogradouro.cfm','Logradouro','scrollbars,resizable,width=410,height=220');
     alert('<?php echo sc_convert_encoding("Informe o nome da avenida, alameda, beco, passagem, pra�a, rua, travessa etc. N�o informe o n�mero da casa/lote/apartamento. N�o informe o tipo (avenida, rua, etc) nem o t�tulo ou patente (coronel, tenente, doutor, etc.)", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
     document.Geral.Logradouro.focus();
 }

</script>
<BODY>
  <form name="Geral" method="get" onSubmit="return CriticaCampos();" id="form-cep">
  <input type=hidden name="form_origem" value="<?php echo $form_origem ?>">
  <div class="scGridLabelVert" style="width: auto">CEP</div>

      <table cellpadding="0" cellspacing="0">
          <tr>
              <td class="scGridFieldOddFont">UF:</td><td class="scGridFieldOddFont"><select name="UF" class="scAppDivToolbarInput">
                      <option value="AC">AC</option>
                      <option value="AL">AL</option>
                      <option value="AM">AM</option>
                      <option value="AP">AP</option>
                      <option value="BA">BA</option>
                      <option value="CE">CE</option>
                      <option value="DF">DF</option>
                      <option value="ES">ES</option>
                      <option value="GO">GO</option>
                      <option value="MA">MA</option>
                      <option value="MG">MG</option>
                      <option value="MS">MS</option>
                      <option value="MT">MT</option>
                      <option value="PA">PA</option>
                      <option value="PB">PB</option>
                      <option value="PE">PE</option>
                      <option value="PI">PI</option>
                      <option value="PR">PR</option>
                      <option value="RJ">RJ</option>
                      <option value="RN">RN</option>
                      <option value="RO">RO</option>
                      <option value="RR">RR</option>
                      <option value="RS">RS</option>
                      <option value="SC">SC</option>
                      <option value="SE">SE</option>
                      <option value="SP">SP</option>
                      <option value="TO">TO</option>
                  </select></td>
          </tr>
          <tr>
              <td class="scGridFieldOddFont">Localidade:</td><td class="scGridFieldOddFont"><input class="scAppDivToolbarInput" maxlength="40" name="Localidade" title="Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc)" onblur="document.Geral.Localidade.value = RetiraAcentos(document.Geral.Localidade.value)"></td>
          </tr>
          <tr>
              <td class="scGridFieldOddFont">Tipo:</td><td class="scGridFieldOddFont"><select name="Tipo" class="scAppDivToolbarInput">
                      <option value=""></option>
                      <option value="Avenida">Avenida</option>
                      <option value="Bloco">Bloco</option>
                      <option value="Praça">Praça</option>
                      <option value="Quadra">Quadra</option>
                      <option value="Rua">Rua</option>
                      <option value="Outros">Outros</option>
                  </select></td>
          </tr>
          <tr>
              <td class="scGridFieldOddFont">Logradouro:</td><td class="scGridFieldOddFont"><input class="scAppDivToolbarInput" maxlength="60" name="Logradouro" title="Informe o nome da avenida, alameda, beco, passagem, praça, rua, travessa etc.
Não informe o número da casa/lote/apartamento." onblur="document.Geral.Logradouro.value = RetiraAcentos(document.Geral.Logradouro.value)"></td>
          </tr>
      </table>

      <select name="Opcao" class="scAppDivToolbarInput">
          <option selected value="Contenha" title="Pesquisar os logradouros que contenham o argumento informado.">Que contenha</option>
          <option value="Exatamente" title="Pesquisar os logradouros que sejam exatamente iguais ao argumento informado.">Exatamente</option>
          <option value="Comecando" title="Pesquisar os logradouros que comecem com o argumento fornecido.">Começando</option>
          <option value="Terminando" title="Pesquisar os logradouros que terminem com o argumento fornecido.">Termiando</option>
      </select>

    <div class="form-footer" style="padding: 10px 0px">
        <button name="BUSCAR" type="submit" class="scButton_small scButton_check scButton_primary_sm">Pesquisar</button>
        <button name="fechar" type="button" class="scButton_small scButton_cancel scButton_danger_sm" onclick="nm_fecha_janela()">Sair</button>
    </div>

  </form>
<script Language="JavaScript">
<?php
   if (isset($_SESSION['scriptcase']['cep_ult_estado']) && (!isset($Est) || empty($Est)))
   {
       $Est = $_SESSION['scriptcase']['cep_ult_estado'];
   }
   if (isset($_SESSION['scriptcase']['cep_ult_cidade']) && (!isset($Localidade) || empty($Localidade)))
   {
       $Localidade = $_SESSION['scriptcase']['cep_ult_cidade'];
   }

   if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
   {
       $Localidade = sc_convert_encoding($Localidade, $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1");
       $Logradouro = sc_convert_encoding($Logradouro, $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1");
       $Tipo       = sc_convert_encoding($Tipo, $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1");
  }
?>
   opc_ant = "<?php echo $Opcao ?>";
   document.Geral.UF.value = "<?php echo $Est ?>";
   document.Geral.Localidade.value = "<?php echo $Localidade ?>";
   document.Geral.Tipo.value = "<?php echo $Tipo ?>";
   document.Geral.Logradouro.value = "<?php echo $Logradouro ?>";
   if (opc_ant == "Contenha")
   {
       document.Geral.Opcao[0].checked = true;
   }
   if (opc_ant == "Exatamente")
   {
       document.Geral.Opcao[1].checked = true;
   }
   if (opc_ant == "Comecando")
   {
       document.Geral.Opcao[2].checked = true;
   }
   if (opc_ant == "Terminando")
   {
       document.Geral.Opcao[3].checked = true;
   }
</script>
</BODY>
</HTML>