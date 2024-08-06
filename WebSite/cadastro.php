<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
            require_once "connect.php";
            $nome = $_GET["nome"];
            $qtd = $_GET["qtd"];
            $preco = $_GET["preco"];
            $taxa = $_GET["taxa"];
            $data = $_GET["data"];
            $meta = $_GET["meta"];
            $ordem = $_GET["ordem"];
            $mtaxa = $_GET["mtaxa"];
            $status = $_GET["status"];
            if(!is_null($nome) || !is_null($data) || !is_null($valor) || !is_null($qtd)){
                $query = "INSERT INTO compra (nome, quantidade, preco, taxa, data, meta, ordem, mtaxa, status) VALUES ('$nome', '$qtd', '$preco', '$taxa', '$data', '$meta', '$ordem', '$mtaxa', '$status')";
                if($banco->query($query)){
                        echo "<script>alert('$nome foi cadastrado com sucesso')</script>";
                }
                else{
                    echo "<script>alert(Error: ".$query."<br>".$banco->error.")</script>";
                }
            }
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="icon" href="img/icon.png">
        <link rel="stylesheet" href="css/estilo.css">
        <title>Cadastrar Ativos</title>
    </head>
    <style>
        input, select {
            width: 100%;
            padding: 12px 20px;
            margin: 18px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        #cadastro {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
    <body>
        <nav class="navbar bg-dark border-bottom border-body navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="index.php">Minhas Ordens</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="cadastro.php">Cadastrar Ordem</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="calcular.php">Calcular Lucro</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 style="text-align: center; margin:15px;">Cadastro de Ordens</h1>
        <div>    
            <form action="cadastro.php" method="GET">
                Nome da moeda: <input name="nome" type="text">
                Número da Ordem: <input name="ordem" type="text">
                Quantidade: <input name="qtd" type="float">
                Preço de compra: <input name="preco" type="text">
                Taxa: <input name="taxa" type="text">
                Moeda de Taxa: <input name="mtaxa" type='text'>
                Data da compra: <input name="data" type="date">
                Meta: <input name="meta" type="text">
                Tipo: <select name="tipo"><option value="Compra">Compra</option><option value="Venda">Venda</option></select>
                Status: <select name="status"><option value="Aberta">Aberta</option><option value="Executada">Executada</option></select>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>