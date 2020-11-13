<?php
error_reporting(0);
header("Content-Type: text/html; charset=UTF-8",true);

//DB details
$dbHost     = '192.168.0.6';
$dbUsername = 'root';
$dbPassword = 'cgti*426';
$dbName     = 'siav';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$db->set_charset("utf8");
if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}

//get records from database
$query = $db->query("SELECT
                        CONCAT('\'',ec.cnpj) AS CNPJ,
                        e.anoBase as 'Ano Base',
                        e.razaoSocial as 'Razão Social',
                        e.cnpjMatriz as 'CNPJ Matriz',
                        e.telefone as 'Telefone',
                        e.fax as 'Fax',
                        ae.email as 'E-Mail',
                        munic.municipio as 'Município',
                        munic.uf as 'UF',
                        CONCAT(e.endereco,', ',e.bairro,', ',e.cep,', ',munic.municipio,', ',munic.uf) as 'Endereço',
                        case ec.`status` when 1 then 'Não Iniciado' when 2 then 'Iniciado' when 3 then 'Concluído' when 4 then 'Expirado' end AS Situação
                        FROM empresacampanha ec
                        LEFT JOIN autenticacaoempresa ae ON ae.cnpj = ec.cnpj
                        LEFT JOIN empresacontrole ecom ON ecom.cnpj = ec.cnpj AND ecom.idCampanha = ec.idCampanha
                        LEFT JOIN empresa e ON e.idEmpresa = ecom.idEmpresa
                        LEFT JOIN municipio munic ON munic.idMunicipio = e.idMunicipio
                        WHERE
                        ec.idCampanha = 14
                        GROUP BY
                        ec.cnpj");

//echo var_dump($query->fetch_assoc());exit;
if($query->num_rows > 0){
    $delimiter = ";";
    //$filename = "members_" . date('Y-m-d') . ".csv";
    $filename = "siav-relatorio.csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        array_walk($row, 'procCampo');
        //$status = ($row['status'] == '1')?'Active':'Inactive';
        if (!$i) 
            $i = fputcsv($f, array_keys($row), $delimiter,'"');
        fputcsv($f, $row, $delimiter,'"');
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}

function procCampo(&$val,$key){
    if ($val == '')
        $val = "N/A";
    else
        //$val = "'".$val."'";
        $val = $val;
}

exit;

?>