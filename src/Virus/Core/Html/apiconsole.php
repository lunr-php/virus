<div class="methods">
<div class="logo"><img src="<?= $this->statics('images/platforms/' . $this->response->get_response_data('platform') . '_small.png'); ?>"></div>
<?php foreach ($this->response->get_response_data('methods') as $method): ?>
<div class="method"><?= $method ?></div>
<?php endforeach; ?>
</div>

<div class="params">
<input type="text" name="apikey" value="APIKEY">
<input type="submit" id="submit_request" value="Make Request">
</div>

<div class="output">

</div>

<script src="<?= $this->statics('js/jquery.min.js'); ?>"></script>
<script src="<?= $this->statics('js/jquery.transit.min.js'); ?>"></script>
<script src="<?= $this->statics('js/apiconsole.js'); ?>"></script>
