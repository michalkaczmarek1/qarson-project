<?php require_once('layouts/header.phtml'); ?>

<button class="btn btn-success" id="read">Pobierz dane</button>
<button class="btn btn-warning" id="refresh">Odswież dane</button>

<script src="<?php echo APP_JS; ?>read.js"></script>
<script src="<?php echo APP_JS; ?>change.js"></script>
<script src="<?php echo APP_JS; ?>delete.js"></script>

<?php require_once('layouts/footer.phtml'); ?>