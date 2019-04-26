<?php

	if(phpversion() >= 7) {
        include(dirname(__FILE__, 3) . '/functions.php');
    } else {
        include(realpath(__DIR__ . '/../..') . '/functions.php');
    }

	$fields = all_fields();
	uasort($fields, 'fields_sort')

?>

<form class="reservation" id="reservation" method="POST">
	
	<!--FIRST STEP-->
	<div class="row">
		<?php foreach ($fields as $field) { ?>
			
			<?php if($field->field_state) { ?>

				<div class="form-group col-12 <?php echo "col-md-$field->field_columns"; ?>">
				
					<label for="<?php echo $field->field_id; ?>">
						<?php if($field->field_required == 'true') { echo '<span class="req">*</span>'; } ?>
						<?php echo $field->field_label; ?>
					</label>

					<?php 

						switch ($field->field_type) {
							case 'text': ?>
								<input 
									type="text" 
									name="<?php echo $field->field_name; ?>" 
									id="<?php echo $field->field_id; ?>" 
									class="<?php echo $field->field_class; ?>" 
									placeholder="<?php echo $field->field_placeholder; ?>" 
									autocomplete="<?php echo $field->field_autocomplete; ?>" 
									<?php if($field->field_required == 'true') { echo 'required'; } ?>
								/>
							<?php break;

							case 'email': ?>
								<input 
									type="email" 
									name="<?php echo $field->field_name; ?>" 
									id="<?php echo $field->field_id; ?>" 
									class="<?php echo $field->field_class; ?>" 
									placeholder="<?php echo $field->field_placeholder; ?>"
									autocomplete="<?php echo $field->field_autocomplete; ?>"  
									<?php if($field->field_required == 'true') { echo 'required'; } ?>
								/>
							<?php break;

							case 'select': ?>

								<select
									name="<?php echo $field->field_name; ?>" 
									id="<?php echo $field->field_id; ?>" 
									class="<?php echo $field->field_class; ?>"
									<?php if($field->field_required == 'true') { echo 'required'; } ?>
								>
									<option value="0" selected><?php echo $field->field_placeholder; ?></option>
									<?php 

										$options = explode(',', $field->field_options);
										foreach ($options as $opt) { ?>
											<option value="<?php echo $opt; ?>"><?php echo $opt; ?></option>
									<?php } ?>
										
								</select>
							
							<?php break;

							case 'email': ?>
								<input 
									type="email" 
									name="<?php echo $field->field_name; ?>" 
									id="<?php echo $field->field_id; ?>" 
									class="<?php echo $field->field_class; ?>" 
									placeholder="<?php echo $field->field_placeholder; ?>" 
									autocomplete="<?php echo $field->field_autocomplete; ?>"  
									<?php if($field->field_required == 'true') { echo 'required'; } ?>
								/>
							<?php break;

							case 'date': ?>
								<input 
									type="text" 
									name="<?php echo $field->field_name; ?>"
									id="<?php echo $field->field_id; ?>" 
									class="<?php echo $field->field_class; ?> date-select" 
									placeholder="<?php echo $field->field_placeholder; ?>" 
									autocomplete="<?php echo $field->field_autocomplete; ?>"  
									<?php if($field->field_required == 'true') { echo 'required'; } ?>
								/>
							<?php break;

							case 'hour': ?>
								<input 
									type="text" 
									name="<?php echo $field->field_name; ?>" 
									id="<?php echo $field->field_id; ?>" 
									class="<?php echo $field->field_class; ?> hour-select" 
									placeholder="<?php echo $field->field_placeholder; ?>" 
									autocomplete="<?php echo $field->field_autocomplete; ?>"  
									<?php if($field->field_required == 'true') { echo 'required'; } ?>
								/>
							<?php break;

							default: ?>
								<input 
									type="text" 
									name="<?php echo $field->field_name; ?>" 
									id="<?php echo $field->field_id; ?>" 
									class="<?php echo $field->field_class; ?>" 
									placeholder="<?php echo $field->field_placeholder; ?>" 
									autocomplete="<?php echo $field->field_autocomplete; ?>"  
									<?php if($field->field_required == 'true') { echo 'required'; } ?>
								/>
							<?php break;
						}

					 ?>
				</div>

			<?php } ?>

		<?php } ?>


	</div>
	
	<div class="row buttons-bar">
		<div class="col">
			<input type="hidden" id="src" name="src" value="reservations">
	  		<input type="hidden" id="action" name="action" value="create">
			<input type="submit" id="ecw_right-btn" class="btn reservar" value="Reservar">
			<input type="reset" id="ecw_left-btn" class="btn reset" value="Limpiar">
		</div>
	</div>

</form>

<div class="modal-reservation">
    <div class="body">
        <img id="spinner" class="icons" src="<?php echo ECWR_DIR ?>inc/public/views/img/spinner.png">
        <img id="check" class="icons" src="<?php echo ECWR_DIR ?>inc/public/views/img/check.png">
        <p class="subtitle color-blue" id="text-modal">Espera un momento...</p>
    </div>
</div>