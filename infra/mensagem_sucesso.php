<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../style/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<?php if (!empty($erro)): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong>⚠️ Ops!</strong>
        <?= htmlspecialchars($erro) ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar">
        </button>

    </div>

<?php endif; ?>


<?php if (!empty($sucesso)): ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <strong>✅ Sucesso!</strong>
        <?= htmlspecialchars($sucesso) ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar">
        </button>

    </div>

<?php endif; ?>