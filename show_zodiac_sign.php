<?php include('header.php'); ?>

<?php
// Recebe a data de nascimento
$data_nascimento = $_POST['data_nascimento'];

// Carrega o arquivo XML
$signos = simplexml_load_file("signos.xml");

// Função para converter as datas e checar o signo
function obterSigno($data, $signos) {
    $data = DateTime::createFromFormat('d/m/Y', $data);
    $dia = $data->format('d/m');
    
    foreach ($signos->signo as $signo) {
        $dataInicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
        $dataFim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
        
        // Ajusta o ano para comparação
        $dataInicio->setDate($data->format('Y'), $dataInicio->format('m'), $dataInicio->format('d'));
        $dataFim->setDate($data->format('Y'), $dataFim->format('m'), $dataFim->format('d'));
        
        if ($data >= $dataInicio && $data <= $dataFim) {
            return $signo;
        }
    }
    return null;
}

// Obtém o signo baseado na data de nascimento
$signo = obterSigno($data_nascimento, $signos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Signo</title>
</head>
<body>
    <div class="signo-container">
        <h1 class="signo-nome"><?php echo $signo->signoNome; ?></h1>
        <p class="signo-descricao"><?php echo $signo->descricao; ?></p>
    </div>
</body>
</html>

