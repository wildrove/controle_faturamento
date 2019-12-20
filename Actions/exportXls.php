<?php
    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "  <table border='1' >";
    $dadosXls .= "      <tr>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>ID</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>CONVENIO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>Nº FATURA</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>Nº FATURAMENTO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>DATA FECHAMENTO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>VALOR</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>DATA POSSIVEL PAGAMENTO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>DATA PAGAMENTO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>PAGO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>CONCILIADO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>VALOR PAGO</th>";
    $dadosXls .= "        <th style='background-color: rgb(0,51,153);color: #fff; text-align: center;padding: 5px;'>VALOR GLOSA</th>";
    $dadosXls .= "      </tr>";


    require '../vendor/autoload.php';
    use Classes\DBConnection\DBConnection;
    use Classes\Faturamento\ControleFaturamento\ControleFaturamento;
    //instanciamos
    $revenue = new ControleFaturamento();
    $result = $revenue->exportXls();
    //varremos o array com o foreach para pegar os dados
    
    foreach($result as $res){
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <td>".$res['ID_CONTROLE']."</td>";
        $dadosXls .= "          <td>".$res['CONVENIO']."</td>";
        $dadosXls .= "          <td>".$res['NUM_FATURA']."</td>";
        $dadosXls .= "          <td>".$res['NUM_FATURAMENTO']."</td>";
        $dadosXls .= "          <td>".$res['DT_FECHAMENTO']."</td>";
        $dadosXls .= "         <td>".str_replace(".", ",", strval($res['VALOR']))."</td>";
        $dadosXls .= "         <td>".$res['DT_POSSIVEL_PAGAMENTO']."</td>";
        $dadosXls .= "         <td>".$res['DT_PAGAMENTO']."</td>";
        $dadosXls .= "         <td>".$res['PAGO']."</td>";
        $dadosXls .= "         <td>".$res['CONCILIADO']."</td>";
        $dadosXls .= "         <td>".str_replace(".", ",", strval($res['PAGO']))."</td>";
        $dadosXls .= "         <td>".str_replace(".", ",", strval($res['VL_GLOSA']))."</td>";
        $dadosXls .= "      </tr>";
    }
    $dadosXls .= "  </table>";
 
    // Definimos o nome do arquivo que será exportado  
    $arquivo = "Lista Faturamento.xls";  
    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');
       
    // Envia o conteúdo do arquivo  
    echo  utf8_decode($dadosXls);  
    exit;
?>