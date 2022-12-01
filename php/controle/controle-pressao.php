<?php
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    include_once (__DIR__."/../utils/autoload.php");

    try {
        //Cadastrar Pressão Sonora
        $moni = new Monitor($_POST['id_monitor'], '', '', '', '', '');
        $pressao = new Pressao('', $_POST['area_moni'], $_POST['data_amostra'], $_POST['hora_moni'], $_POST['num_deci'], $_POST['relatorio'], $moni);

        if($moni->create()){
            header("Location: ../../view/pressao-sonora/pressao-monitora.php?msg=sucesso");
        } else {
            header("Location: ../../view/pressao-sonora/pressao-monitora.php?msg=falha");            
        }
    } catch(Exception $e) {
        echo "<h1>Erro ao cadastrar as informações.</h1><br> Erro:".$e->getMessage();
    }
?>
<?php
    include_once (__DIR__."/../utils/autoload.php");

    try {
        if($acao == 'update') {
            //Atualizar relatório
            $moni = new Monitor($_POST['id_monitor'], '', '', '', '', '');
            $pressao = new Pressao ($_POST['id_pressao'], $_POST['area_moni'], $_POST['data_amostra'], $_POST['hora_moni'], $_POST['num_deci'], $_POST['relatorio'], $moni);
            $pressao->update();
            header("Location: ../../view/pressao-sonora/pressao-monitora.php?msg=");
        } else if($acao == 'delete') {
            //Deletar relatório
            $cons = new Consulta($_GET['consId'], '', '', '', '', $paci);
            $rela = new Relatorio($_GET['relaId'], $_POST['relaDescricao'], $_POST['relaMedicamentos'], $_POST['relaExames'], $cons);
            $rela->delete();
            header("Location: ../../view/consulta/visualizar-consulta.php?msg=Relatório cadastrado com sucesso!");
        } else {
            //Gerar relatório
            $cons = new Consulta($_GET['consId'], '', '', '', '', $paci);
            $rela = new Relatorio('', '', '', '', $cons);
            $rela->create();
            header("Location: ../../view/consulta/visualizar-consulta.php?msg=Relatório cadastrado com sucesso!");
        }
    } catch(Exception $e) {
        echo "<h1>Erro ao modificar as informações.</h1><br> Erro:".$e->getMessage();
    }
?>