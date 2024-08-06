<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
            require_once "connect.php";
            $id = $_GET["id"];
            $nome = $_GET["nome"];
            $data = $_GET["data"];
            $valorc = $_GET["valorc"];
            $valorv = $_GET["valorv"];
            if(!is_null($id)){
                $query1 = "SELECT * from compra where ID like $id";
                $result = $banco->query($query1);
                $obj = $result->fetch_object();
            }
            if(!is_null($valorv) && !is_null($valorc)){
                $dif = $valorv - $valorc;
                $porcentagem = number_format(($dif/$valorc)*100, 3);
                $lucro = number_format(($porcentagem/100)*$valorc, 2);
            }
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="icon" href="img/icon.png">
        <link rel="stylesheet" href="css/estilo.css">
        <title>Calculadora de lucro</title>
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
                        <a class="nav-link" href="cadastro.php">Cadastrar Ordem</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="calcular.php">Calcular Lucro</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 style="text-align: center; margin:15px;">Calculadora</h1> 
        <div>    
            <form action="calcular.php" method="GET">
                Valor da compra (R$): <input name="valorc" type="float" value="<?php echo $obj->preco?>">
                Valor da venda (R$): <input name="valorv" type="float" value="<?php if(!is_null($id)){echo $api->price($obj->nome."BRL");}?>">
                <input type="submit" value="Enviar">
            </form>
        </div>
        <?php
            if(isset($valorc) && isset($valorv)){
                echo "<div style='text-align: center; padding: 10px; border-radius: 5px; background-color: white; font-size:30px; width: fit-content; height:auto; margin:auto;'> Compra: R$$valorc <br> Venda: R$".number_format($valorv, 3)." <br>".$porcentagem."% de Lucro"."<br>R$".$lucro." de Lucro"." </div>";
            }
        ?>
    </body>
    <script src="js/bootstrap.min.js"></script>
</html>