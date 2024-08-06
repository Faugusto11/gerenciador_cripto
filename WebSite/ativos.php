<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
            require_once "connect.php";
            $filtro = $_GET["filtro"];
            $filtro2 = $_GET["filtro2"];
            switch($filtro){
                case 1:
                $query = "SELECT * from compra where tipo = 'Compra'";
                break;
                case 2:
                $query = "SELECT * from compra where tipo = 'Venda'";
                break;
                default:
                $query = "SELECT * from compra WHERE 1=1";
            }
            switch($filtro2){
                case 1:
                    $query = $query." AND status = 'Aberta'";
                    break;
                case 2:
                    $query = $query." AND status = 'Executada'";
                    break;
                default:
                break;
            }
            $query = $query." ORDER BY nome";
            $total = 0;
            $investido = 0;
            if($result = $banco->query($query)){
                while($obj = $result->fetch_object()){
                    $price = $api->price($obj->nome."BRL");
                    $investido += number_format($obj->quantidade * $obj->preco, 2);
                    $total += number_format($price * $obj->quantidade - $obj->preco * $obj->quantidade, 2);
                }
                if($obj->quantidade != 0 && $obj->preco !=0){
                    $percentual = number_format($total/$investido * 100,2);
                }
            }
            
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" href="img/icon.png">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/popup.css">
        <title>Meus Ativos</title>
    </head>
    <script src="js/bootstrap.bundle.js">
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>
    <style>
    button{
        margin-left: 10px;
        border: none;
    }
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
  
    td, #ativos th {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    
    tr:nth-child(even){background-color: #f2f2f2;}
    
    tr:hover {background-color: #ddd;}
    
    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #04AA6D;
        color: white;
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
                        <a class="nav-link  active" href="index.php">Minhas Ordens</a>
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
        <h1 style="text-align: center; margin:15px;">Tabela de Compras</h1>
        <table>
            <th>Ordem</th><th>Moeda</th><th>Quantidade</th><th>Lucro Atual<?php echo " (".number_format($total/$investido*100, 2) ."%)";?></th><th>Lucro <?php echo "(R$$total)"?></th><th>Meta</th><th>Atual</th><th>Compra<th>Investido <?php echo "(R$$investido)"?></th><th>Idade (Dias)</th><th>Tipo<div class="popup" onclick="myFunction()"><img src="img/filtro.png" height="20px" style="margin-left: 10px;"><span class="popuptext" id="myPopup"><a href="index.php?&filtro2=<?php echo $filtro2; ?>">Sem Filtro<br></a><a href="index.php?filtro=1&filtro2=<?php echo $filtro2; ?>">Compra<br></a><a href="index.php?filtro=2&filtro2=<?php echo $filtro2; ?>">Venda<br></a></span></div></th><th>Status<div class="popup" onclick="myFunction2()"><img src="img/filtro.png" style="margin-left: 10px;" height="20px"><span class="popuptext" id="myPopup2"><a href="index.php?filtro=<?php echo $filtro;?>">Sem Filtro<br></a><a href="index.php?filtro2=1&filtro=<?php echo $filtro;?>">Aberta<br></a><a href="index.php?filtro2=2&filtro=<?php echo $filtro;?>">Executada<br></a></span></div>
            </th><th>Controle</th>
            <?php
                if($result = $banco->query($query)){
                    while($obj = $result->fetch_object()){
                        $price = $api->price($obj->nome."BRL");
                        /*$data = $obj->data;
                        $hoje = date("Y-m-d");
                        $diferenca = date_diff(date_create($data), date_create($hoje));*/
                        $agora = time();
                        $data = strtotime($obj->data);
                        $diferenca = number_format(($agora - $data)/(60*60*24), 0);
                        echo "<tr><td>$obj->ordem<td>$obj->nome<td>$obj->quantidade<td>".number_format(($price - $obj->preco)/$obj->preco*100, 2) ."%<td>R$".number_format($price * $obj->quantidade - $obj->preco * $obj->quantidade,2) ."<td>R$$obj->meta<td>R$".number_format($price, 8)."<td>R$$obj->preco<td> R$" .number_format($obj->preco * $obj->quantidade, 2) ."<td>".$diferenca."<td>$obj->tipo<td>$obj->status<td><a href='editar.php?id=$obj->ID'><img style='height: 30px;' src='img/editar.png'></a><a href='calcular.php?id=$obj->ID'><img style='height: 30px;' src='img/calcular.png'></a>";
                    }
                }else{
                    echo "Erro!";
                }
                
            ?>
        </table>
        <script>
            // When the user clicks on div, open the popup
            function myFunction() {
                var popup = document.getElementById("myPopup");
                popup.classList.toggle("show");
            }
            function myFunction2() {
                var popup = document.getElementById("myPopup2");
                popup.classList.toggle("show");
            }
        </script>
    </body>
</html>