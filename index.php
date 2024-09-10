<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubra seu signo</title>
</head>
<body>

<div id="signo-form-ext" class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h1>Descubra seu signo:</h1>
            <form id="signo-form-int" method="POST" action="show_zodiac_sign.php">
                <div class="form-group mt-4">
                    <label for="data_nascimento">Data de nascimento</label>
                    <input type="text" class="form-control text-center" id="data_nascimento" name="data_nascimento" placeholder="Ex.: 21/05/1992">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Descobrir</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
