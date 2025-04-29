<?php
include '../includes/header.php';
$panier = $_SESSION['panier'] ?? [];
$total = 0;
?>
    <div class="panier-summary">
        <h3>Total : <?= number_format($total, 2) ?> €</h3>
        <?php if (!empty($panier)): ?>
            <form action="payer.php" method="post">
                <button class="btn-payer">Payer</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
