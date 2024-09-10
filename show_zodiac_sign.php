<?php include('header.php'); ?>

<?php
$data_nascimento = $_POST['data_nascimento'];

$signos = simplexml_load_file("signos.xml");

function obterSigno($data, $signos) {
    $data = DateTime::createFromFormat('d/m/Y', $data);
    if (!$data) {
        return null; // Se a data não puder ser formatada corretamente, retorna nulo.
    }

    $dia = $data->format('d/m');

    foreach ($signos->signo as $signo) {
        $dataInicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
        $dataFim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
        
        // Ajustar datas para o mesmo ano da data de nascimento
        $dataInicio->setDate($data->format('Y'), $dataInicio->format('m'), $dataInicio->format('d'));
        $dataFim->setDate($data->format('Y'), $dataFim->format('m'), $dataFim->format('d'));

        // Tratamento para signos que atravessam o ano (Capricórnio, por exemplo)
        if ($dataFim < $dataInicio) {
            $dataFim->modify('+1 year');
        }

        // Comparar a data de nascimento com o intervalo do signo
        if ($data >= $dataInicio && $data <= $dataFim) {
            return $signo;
        }
    }
    return null; // Retorna null se nenhum signo for encontrado
}

$signo = obterSigno($data_nascimento, $signos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Signo</title>
    <!-- Link para o arquivo CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="signo-container">
        <?php if ($signo): ?>
            <h1 class="signo-nome"><?php echo $signo->signoNome; ?></h1>
            <p class="signo-descricao"><?php echo $signo->descricao; ?></p>
            
            <?php if ($signo->imagem): ?>
                <img src="<?php echo $signo->imagem; ?>" alt="Imagem do Signo <?php echo $signo->signoNome; ?>">
            <?php else: ?>
                <p>Imagem não disponível.</p>
            <?php endif; ?>
        <?php else: ?>
            <h1>Signo não encontrado</h1>
            <p>Verifique se a data de nascimento foi inserida corretamente.</p>
        <?php endif; ?>
    </div>
</body>
</html>
