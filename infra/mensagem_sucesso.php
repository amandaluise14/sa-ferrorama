
<?php if (!empty($erro)): ?>

    <div class="alert alert-danger alert-dismissible fade show
        position-fixed top-0 start-50 translate-middle-x mt-3"
        role="alert" style="z-index: 1055; width: 90%; max-width: 500px;">

        <strong>⚠️ Atenção!</strong>
        <?= htmlspecialchars($erro) ?>

        <button type="button" class="btn-close"
            data-bs-dismiss="alert" aria-label="Fechar">
        </button>
    </div>

<?php endif; ?>

<?php if (!empty($sucesso)): ?>

    <div class="alert alert-success alert-dismissible fade show
        position-fixed top-0 start-50 translate-middle-x mt-3"
        role="alert" style="z-index: 1055; width: 90%; max-width: 500px;">

        <strong>✅ Sucesso!</strong>
        <?= htmlspecialchars($sucesso) ?>

        <button type="button" class="btn-close"
            data-bs-dismiss="alert" aria-label="Fechar">
        </button>
    </div>

<?php endif; ?>
