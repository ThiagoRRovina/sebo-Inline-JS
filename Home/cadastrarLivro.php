<?php
    include_once 'conectaBanco.php';
    $mensagem = '';
    // Excluir livro
    if (isset($_GET['excluir'])) {
        $idExcluir = $_GET['excluir'];
        $sql = "DELETE FROM livros WHERE id = $1";
        $result = pg_query_params($conn, $sql, array($idExcluir));
        if ($result) {
            $mensagem = 'Livro excluído com sucesso!';
            header('Location: livros.html');
            exit;
        } else {
            $mensagem = 'Erro ao excluir livro.';
        }
    }
    // Salvar ou editar livro
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $paginas = $_POST['paginas'];
        $editora = $_POST['editora'];
        $ano = $_POST['ano'];
        $data = $_POST['data'];
        $preco = $_POST['preco'];

        // Upload da imagem
        if (isset($_FILES['capa']) && $_FILES['capa']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION);
            $novoNome = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['capa']['tmp_name'], 'capas/' . $novoNome);
            $capa = $novoNome;
        } else {
            $capa = 'placeholder-capa.jpg';
        }

        if ($id) {
            // Editar
            $sql = "UPDATE livros SET livro_titulo=$1, livro_autor=$2, livro_paginas=$3, livro_editora=$4, livro_ano=$5, livro_data_cadastro=$6, livro_preco=$7, livro_capa=$8 WHERE livro_id=$9";

            $params = array($titulo, $autor, $paginas, $editora, $ano, $data, $preco, $capa, $id);
            $result = pg_query_params($conn, $sql, $params);
            $mensagem = $result ? 'Livro editado com sucesso!' : 'Erro ao editar livro.';

        } else {
            // Novo livro
            $sql = "INSERT INTO livros (livro_titulo, livro_autor, livro_paginas, livro_editora, livro_ano, livro_data_cadastro, livro_preco, livro_capa) VALUES ($1,$2,$3,$4,$5,$6,$7,$8)";
            $params = array($titulo, $autor, $paginas, $editora, $ano, $data, $preco, $capa);
            $result = pg_query_params($conn, $sql, $params);
            $mensagem = $result ? 'Livro cadastrado com sucesso!' : 'Erro ao cadastrar livro.';
            header('Location: livros.html');
            exit;
        }
    }

?>