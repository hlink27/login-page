<?php include $_SERVER['DOCUMENT_ROOT'] . "/login-page/includes/head.html"; ?>
<title>Adicionar Filme</title>
</head>

<body class="main-container">
    <a href="../index.php" class="btn btn-outline-primary">Voltar</a>
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Adicionar Filme</h5>
            <form action="addmovie.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Título</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="title" name="title">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">URL Image</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="url" name="url">
                </div>
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="synopsis"></textarea>
                        <label for="floatingTextarea">Sinopse</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="watched">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Já Assisti</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Nota</span>
                    <input type="number" min="0" max="10" step="0.1" class="form-control" id="notaInput" aria-label="Amount (to the nearest dollar)" name="grade">
                    <span class="input-group-text">/ 10</span>
                </div>
                <script>
                    //grade is only possible when "watched" is marked
                    const checkbox = document.getElementById('flexSwitchCheckDefault');
                    const notaInput = document.getElementById('notaInput');
                    notaInput.disabled = true;
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            notaInput.disabled = false;
                        } else {
                            notaInput.value = null
                            notaInput.disabled = true;
                        }
                    });
                </script>
                <input class="btn btn-primary" type="submit" value="Registrar">
            </form>
        </div>
    </div>
</body>

</html>