<?php
foreach ($lista as $list): ?>
<option value="<?php echo $list->codigo_sector ?>"><?php echo $list->sector ?></option>
<?php endforeach; ?>
<option value="_nvo">Nuevo Sector</option>

