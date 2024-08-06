<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
            require_once "connect.php";
            $id = $_GET["id"];
            $confirmar = $_GET["confirmar"];
            $nome = $_GET["nome"];
            $qtd = $_GET["qtd"];
            $preco = $_GET["preco"];
            $taxa = $_GET["taxa"];
            $mtaxa = $_GET["mtaxa"];
            $data = $_GET["data"];
            $ordem = $_GET["ordem"];
            $meta = $_GET["meta"];
            $status = $_GET["status"];
            $tipo = $_GET["tipo"];
            $query1 = "SELECT * from compra where ID like $id";
            $result = $banco->query($query1);
            $obj = $result->fetch_object();
            if(!is_null($confirmar)){
                $query = "UPDATE compra SET nome = '$nome', tipo='$tipo', status='$status', mtaxa = '$mtaxa',ordem = '$ordem', data = '$data', preco = '$preco', meta = '$meta', quantidade = '$qtd', taxa = '$taxa' where id = '$obj->ID'";
                if($banco->query($query)){
                    echo "<script>alert('O ativo $nome foi editado com sucesso')</script>";
                    header("Location: index.php");
                    exit;
                }
                else{
                    echo "<script>alert(Error: ".$query."<br>".$banco->error.")</script>";
                }
            }
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/icon.png">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilo.css">
        <title>Editar Ativo</title>
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
                        <a class="nav-link active" href="index.php">Minhas Ordens</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastrar Ordem</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="calcular.php">Calcular Lucro</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 style="text-align: center; margin:15px;">Editar Ativo</h1>
        <div>    
            <form action="editar.php" method="GET">
                Nome da moeda: <input name="nome" type="text" value="<?php echo $obj->nome ?>">
                Número da ordem: <input name="ordem" type="text" value="<?php echo $obj->ordem ?>">
                Quantidade: <input name="qtd" type="float" value="<?php echo $obj->quantidade?>">
                Preço de compra: <input name="preco" type="text" value="<?php echo $obj->preco?>">
                Taxa: <input name="taxa" type="text" value="<?php echo $obj->taxa?>">
                Moeda de Taxa: <input name="mtaxa" type="text" value="<?php echo $obj->mtaxa?>">
                Data da compra: <input name="data" type="date" value="<?php echo $obj->data?>">
                Meta: <input name="meta" type="text" value="<?php echo $obj->meta?>">
                Status: <select name="status"><option value="<?php echo $obj->status?>"><?php echo $obj->status ?></option><option value="Aberta">Aberta</option><option value="Executada">Executada</option></select>
                Tipo: <select name="tipo"><option value="<?php echo $obj->tipo?>"><?php echo $obj->tipo ?></option><option value="Compra">Compra</option><option value="Venda">Venda</option></select>
                <input type="hidden" name="id" value="<?php echo $obj->ID?>">
                <input type="hidden" name="confirmar" value="1">
                <input type="submit" value="Enviar">
            </form>
        </div>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>