<ul id="selectHourZone">
	<label for="hs1"><li <?php echo (isset($_GET['hourZone']) && in_array(1, $_GET['hourZone'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="hourZone[]" id="hs1" value="1" <?php echo (isset($_GET['hourZone']) && in_array(1, $_GET['hourZone'])) ? 'checked' : ''; ?>>早朝<br><small>(5〜9時)</small></li></label>
	<label for="hs2"><li <?php echo (isset($_GET['hourZone']) && in_array(2, $_GET['hourZone'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="hourZone[]" id="hs2" value="2" <?php echo (isset($_GET['hourZone']) && in_array(2, $_GET['hourZone'])) ? 'checked' : ''; ?>>午前<br><small>(9〜13時)</small><br></li></label>
	<label for="hs3"><li <?php echo (isset($_GET['hourZone']) && in_array(3, $_GET['hourZone'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="hourZone[]" id="hs3" value="3" <?php echo (isset($_GET['hourZone']) && in_array(3, $_GET['hourZone'])) ? 'checked' : ''; ?>>午後<br><small>(13〜16時)</small></li></label>
	<label for="hs4"><li <?php echo (isset($_GET['hourZone']) && in_array(4, $_GET['hourZone'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="hourZone[]" id="hs4" value="4" <?php echo (isset($_GET['hourZone']) && in_array(4, $_GET['hourZone'])) ? 'checked' : ''; ?>>夕方<br><small>(16〜19時)</small><br></li></label>
	<label for="hs5"><li class="ex  <?php echo (isset($_GET['hourZone']) && in_array(5, $_GET['hourZone'])) ? 'on' : ''; ?>"><input type="checkbox" name="hourZone[]" id="hs5" value="5" <?php echo (isset($_GET['hourZone']) && in_array(5, $_GET['hourZone'])) ? 'checked' : ''; ?>>夜間<br><small>(19〜5時)</small></li></label>
</ul>