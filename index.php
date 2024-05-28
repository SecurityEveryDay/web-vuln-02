<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Upload de Arquivo</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .mensagem-sucesso {
            color: #28a745;
        }
        .mensagem-erro {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Envie sua imagem</h1>
        <form action="index.php" method="post" enctype="multipart/form-data" class="p-3">
            <div class="form-group">
                <label for="fileToUpload">Selecione a Imagem para Enviar:</label>
                <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
            </div>
            <input type="submit" class="btn btn-success" value="Enviar" name="submit">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

            if (!is_dir($target_dir) && !mkdir($target_dir, 0777, true)) {
                echo '<div class="alert alert-danger" role="alert">Erro ao criar diretório de uploads.</div>';
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo '<div class="alert alert-success" role="alert">A imagem ' . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . ' foi enviada com sucesso. Acesse-a <a href="/' . htmlspecialchars($target_file) . '" target="_blank">aqui</a>.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Desculpe, houve um erro ao enviar sua imagem.</div>';
                }
            }
        }
        ?>
    </div>
</body>
</html>
