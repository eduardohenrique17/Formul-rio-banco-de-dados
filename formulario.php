<?php
// CONFIGURAÇÕES DE CREDENCIAIS
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'formulario'; // Certifique-se de que o nome do banco de dados esteja correto

// CONEXÃO COM O BANCO DE DADOS
$conn = new mysqli($server, $usuario, $senha, $banco);

// VERIFICAR CONEXÃO
if ($conn->connect_error) {
    die("Falha ao se comunicar com banco de dados: " . $conn->connect_error);
}

// PEGANDO OS DADOS VINDOS DO FORMULÁRIO
$titulo = $_POST['titulo'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$quilometragem = $_POST['quilometragem'];


// PREPARAR COMANDO PARA INSERIR NO BANCO DE DADOS
$sql = "INSERT INTO carros (titulo, preco, descricao, marca, modelo, quilometragem)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// VINCULAR PARÂMETROS
$stmt->bind_param("ssssss", $titulo, $preco, $descricao, $marca, $modelo, $quilometragem);

// EXECUTAR A INSERÇÃO
if ($stmt->execute()) {
    echo "Informações enviadas com sucesso!";
} else {
    echo "Erro no envio: " . $stmt->error;
}

// FECHAR A CONEXÃO
$stmt->close();
$conn->close();
?>
