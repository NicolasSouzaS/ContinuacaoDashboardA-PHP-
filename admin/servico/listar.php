<?php
    require_once('class/servico.php');
    $listaServico = new ServicoClass();
    $listar = $listaServico->ListarStatusOn();

    // Verifica se a requisição veio do AJAX e chama o método LISTAR SERVIÇO DESATIVADO
if (isset($_POST['status']) && !empty($_POST['status'])) {
    $listaServico = new ServicoClass();
    $status = $_POST['status'];
    if ($status == 'desativarServico') {
        //$listaServico->statusServico = 0;
        $listar = $listaServico->ListarDesativado();
 
        $html = '';
        foreach ($listar as $linha) {
            $html .= '<tr>
                    <td>
                        <a href="../img/' . $linha['imgServico'] . '" data-lightbox="image-1" data-title="Nome do Usuário">
                            <img class="imgFotoTabela" src="../img/' . $linha['imgServico'] . '" alt="' . $linha['tituloServico'] . '">
                        </a>
                    </td>
                    <td>' . $linha['tituloServico'] . '</td>
                    <td>' . $linha['textoServico'] . '</td>
                    <td class="imgIcon"><a href="index.php?p=servico&s=atualizar&id=' . $linha['idServico'] . '"><img src="img/pencil.png" alt="ATUALIZAR"></a></td>
                    <td class="imgIcon"><a href="index.php?p=servico&s=desativar&id=' . $linha['idServico'] . '"><img src="img/bin.png" alt="DESATIVAR"></a></td>
                </tr>';
        }
 
        echo $html;
    } else if ($status == 'ativarServico') {
 
        $listaServico->statusServico = 1;
        $listar = $listaServico->Listar();
 
        $html = '';
        foreach ($listar as $linha) {
            $html .= '<tr>
                    <td>
                        <a href="../img/' . $linha['imgServico'] . '" data-lightbox="image-1" data-title="Nome do Usuário">
                            <img class="imgFotoTabela" src="../img/' . $linha['imgServico'] . '" alt="' . $linha['tituloServico'] . '">
                        </a>
                    </td>
                    <td>' . $linha['tituloServico'] . '</td>
                    <td>' . $linha['textoServico'] . '</td>
                    <td class="imgIcon"><a href="index.php?p=servico&s=atualizar&id=' . $linha['idServico'] . '"><img src="img/pencil.png" alt="ATUALIZAR"></a></td>
                    <td class="imgIcon"><a href="index.php?p=servico&s=desativar&id=' . $linha['idServico'] . '"><img src="img/bin.png" alt="DESATIVAR"></a></td>
                </tr>';
        }
 
        echo $html;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./dist/all-animation.css">
    <link rel="stylesheet" href="./dist/all-animation.min.css">
</head>
<body>
    


<div class="">

<div style="margin-bottom:1%;">
                <div class="custom-control custom-radio">
                    <input type="radio" id="ativarServico" name="customRadio" class="custom-control-input">
                    <label class="custom-control-label" for="ativarServico">Listar Serviço Ativo</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="desativarServico" name="customRadio" class="custom-control-input">
                    <label class="custom-control-label" for="desativarServico">Listar Serviço Desativado</label>
                </div>
</div>

<table class="input__container-blog table table-dark table-borderless a-flip-right">
    <caption style="color:white; text-align:center; font-size:20pt" class="input__container-blog">Conteudo Serviço</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>ICONE</th>
                <th>TITULO</th>
                <th>TEXTO</th>
                <th>LINK</th>
                <th>STATUS</th>
                <th>ATUALIZAR</th>
                <th>DESATIVAR</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($listar as $linha): ?>
            <tr>
                <td><?php echo $linha['idServico']?></td>
                <td>
                    <?php
                    if($linha['iconServico'] == NULL){
                        echo 'SEM ICONE';
                    }else{
                        echo $linha['iconServico'];
                    }
                    ?>
                </td>
                <td><?php echo $linha['tituloBlocoServico']?></td>
                <td><?php echo $linha['textoBlocoServico']?></td>
                <td>
                    <?php
                     if($linha['linkSaiba'] == NULL){
                        echo 'SEM LINK';
                    }else{
                        echo $linha['linkSaiba'];
                    }
                    ?>
                </td>

                <td><?php 
                    if($linha['statusServico'] ==1){
                        echo 'ATIVO';
                    }else{
                        echo 'DESATIVADO';
                    }
                ?></td>

                <td><a href="index.php?p=servicoAtualizar&s=atualizar
                &id=<?php echo $linha['idServico']?>">ATUALIZAR</a></td>
                <td><a href="index.php?p=servicoDesativar&s=desativar&
                id=<?php echo $linha['idServico']?>">DESATIVAR</a></td>
            </tr>
            <?php endforeach ?>
        </tbody>

</table>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  

  <script src="./js/script.js"></script>
</body>
</html>