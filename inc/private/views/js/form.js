var service = info.ecw_url + "/inc/models/class.Fields.php";
var campos = [];
const getAllFields = function () {
	$.ajax({
		"method": "POST",
		"url": service,
		"data": {
			"action": "get_all",
			"src": "fields"
		}
	}).done(function(info){
		var json_info = JSON.parse( info );
		campos = json_info;
		list.getFields();
	});
}

var list = new Vue({
  el: '#app',
  data: function() {
  	return {
  		//Form
	  	formTitle: 'Agregar campo',
	  	formBtn: 'Agregar',
	  	formEdit: false,
	  	field: {
	  		field_name: '',
		  	field_label: '',
		  	field_placeholder: '',
		  	field_type: '',
		  	field_id: '',
		  	field_class: '',
		  	field_columns: '12',
		  	field_state: true,
		  	field_required: true,
		  	field_options: '',
		  	field_order: '1'
	  	},
	  	fieldList: [],

	  	//Services
	  	serviceUrl: service
  	}
  },
  methods: {
  	getFields: function() {
  		this.fieldList = campos.data;
  	},
  	save: function() {
  		if(this.formEdit) {

  			let me = this;
  			$.ajax({
				"method": "POST",
				"url": service,
				"data": {
					"action": "update",
					"src": "fields",
					"id": me.field.id,
					"field_name": me.field.field_name,
					"field_label": me.field.field_label,
					"field_placeholder": me.field.field_placeholder,
					"field_type": me.field.field_type,
					"field_id": me.field.field_id,
					"field_class": me.field.field_class,
					"field_columns": me.field.field_columns,
					"field_state": me.field.field_state,
					"field_required": me.field.field_required,
					"field_options": me.field.field_options,
					"field_order": me.field.field_order
				}
			}).done(function(info){
				var json_info = JSON.parse( info );
				console.log(json_info)

				getAllFields();
				me.getFields();
				me.field = { field_name: '', field_label: '', field_placeholder: '', field_type: '', field_id: '', field_class: '', field_columns: '12', field_state: true, field_required: true, field_options: '', field_order: '1' }
				me.formEdit = false;
		    	me.formTitle = 'Agregar campo';
		    	me.formBtn = 'Agregar';
			});

  		} else {

  			let me = this;
  			$.ajax({
				"method": "POST",
				"url": service,
				"data": {
					"action": "create",
					"src": "fields",
					"field_name": me.field.field_name,
					"field_label": me.field.field_label,
					"field_placeholder": me.field.field_placeholder,
					"field_type": me.field.field_type,
					"field_id": me.field.field_id,
					"field_class": me.field.field_class,
					"field_columns": me.field.field_columns,
					"field_state": me.field.field_state,
					"field_required": me.field.field_required,
					"field_options": me.field.field_options,
					"field_order": me.field.field_order
				}
			}).done(function(info){
				var json_info = JSON.parse( info );
				console.log(json_info)

				getAllFields();
				me.getFields();
				me.field = { field_name: '', field_label: '', field_placeholder: '', field_type: '', field_id: '', field_class: '', field_columns: '12', field_state: true, field_required: true, field_options: '', field_order: '1' }
			});

  		}
    },
    deleteField: function(item) {

    	let c = confirm(`¿Seguro deseas eliminar el campo: ${item.field_label}?`);
    	if(c) {
    		let me = this;
			$.ajax({
				"method": "POST",
				"url": service,
				"data": {
					"action": "delete",
					"src": "fields",
					"id": item.id,
				}
			}).done(function(info){
				var json_info = JSON.parse( info );
				console.log(json_info)

				getAllFields();
				me.getFields();
			});
    	}
    },
    changeAction: function(field) {
    	this.formEdit = true;
    	this.formTitle = 'Modificar campo: ' + field.field_name;
    	this.formBtn = 'Actualizar';

    	this.field = field;
    },
    cancel: function() {
    	this.formEdit = false;
    	this.formTitle = 'Agregar campo';
    	this.formBtn = 'Agregar';
    	this.field = { field_name: '', field_label: '', field_placeholder: '', field_type: '', field_id: '', field_class: '', field_columns: '12', field_state: true, field_required: true, field_options: '', field_order: '1' }
    }
  },
  computed: {
  	orderedFields: function () {
      function compare(a, b) {
        if (a.field_order < b.field_order)
          return -1;
        if (a.field_order > b.field_order)
          return 1;
        return 0;
      }

      return this.fieldList.sort(compare);
	}
  },
  template: `
  	<div class="row">
  		<div class="col-12 col-md-5">
  			<h5 class="section-title">Campos del formulario ({{fieldList.length}}):</h5>
			<ul class="fields-list">
				<li v-for="item in orderedFields" :key="item.name">
					<p class="name">{{item.field_label}}</p>
					<p class="type">Tipo de campo: <b>{{item.field_type}}</b></p>
					<div class="actions">
						<a v-on:click="changeAction(item)" class="update-icon">
							<i class="fas fa-edit"></i>
						</a>
						<a v-on:click="deleteField(item)" class="delete-icon">
							<i class="fas fa-trash-alt"></i>
						</a>
					</div>
				</li>
			</ul>
		</div>

		<div class="col-12 col-md-7 col-form">
			<h5 class="section-title">{{formTitle}}</h5>
			<form id="form-fields" class="form-fields">
				
				<div class="row">
					<div class="form-group col-12">
						<label for="label_field">Etiqueta del campo:</label>
						<input type="text" name="label_field" id="label_field" class="form-control" placeholder="Etiqueta del campo..." v-model="field.field_label">
					</div>

					<div class="form-group col-12">
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-text" v-on:click="field.field_type = 'text'" v-model="field.field_type" value="text" />
							<label for="type-text">Texto</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-email" v-on:click="field.field_type = 'email'" v-model="field.field_type" value="email" />
							<label for="type-email">Correo electrónico</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-textarea" v-on:click="field.field_type = 'textarea'" v-model="field.field_type" value="textarea" />
							<label for="type-textarea">Área de texto</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-select" v-on:click="field.field_type = 'select'" v-model="field.field_type" value="select" />
							<label for="type-select">Lista desplegable</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-date" v-on:click="field.field_type = 'date'" v-model="field.field_type" value="date" />
							<label for="type-date">Calendario</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-hour" v-on:click="field.field_type = 'hour'" v-model="field.field_type" value="hour" />
							<label for="type-hour">Reloj</label>
						</div>
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="name_field">Name del campo:</label>
						<input type="text" name="name_field" id="name_field" class="form-control" placeholder="Name del campo..." v-model="field.field_name">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="placeholder_field">Placeholder del campo:</label>
						<input type="text" name="placeholder_field" id="placeholder_field" class="form-control" placeholder="Texto de ejemplo" v-model="field.field_placeholder">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="id_field">ID del campo:</label>
						<input type="text" name="id_field" id="id_field" class="form-control" placeholder="id-de-ejemplo" v-model="field.field_id">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="class_field">Clase del campo:</label>
						<input type="text" name="class_field" id="class_field" class="form-control" placeholder="clase-de-ejemplo" v-model="field.field_class">
					</div>

					<div class="form-group col-6">
						<label for="columns_field">Columnas del campo:</label>
						<select name="columns_field" id="columns_field" v-model="field.field_columns">
							<option v-bind:value="0">Seleccione un número de columnas</option>
							<option v-bind:value="2">2</option>
							<option v-bind:value="3">3</option>
							<option v-bind:value="4">4</option>
							<option v-bind:value="5">5</option>
							<option v-bind:value="7">7</option>
							<option v-bind:value="6">6</option>
							<option v-bind:value="8">8</option>
							<option v-bind:value="9">9</option>
							<option v-bind:value="10">10</option>
							<option v-bind:value="11">11</option>
							<option v-bind:value="12">12</option>
						</select>
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="field_order">Posición:</label>
						<input type="number" name="field_order" id="field_order" class="form-control" placeholder="Posición del campo, ejemplo: 1" v-model="field.field_order">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="field_state">Estado del campo:</label><br/>
						<div class="form-check form-check-inline">
							<input type="radio" name="state" id="type-active" v-on:click="field.field_state = true" v-model="field.field_state" value="true" />
							<label for="type-active">Activo</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="state" id="type-inactive" v-on:click="field.field_state = false" v-model="field.field_state" value="false" />
							<label for="type-inactive">Desactivado</label>
						</div>
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="field_required">¿Campo obligatorio?</label><br/>
						<div class="form-check form-check-inline">
							<input type="radio" name="required" id="field-required" v-on:click="field.field_required = true" v-model="field.field_required" value="true" />
							<label for="field-required">Obligatorio</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="required" id="field-optional" v-on:click="field.field_required = false" v-model="field.field_required" value="false" />
							<label for="field-optional">Opcional</label>
						</div>
					</div>

					<div class="form-group col-12">
						<input type="button" id="save" class="button" v-on:click="save" :value="formBtn" />

						<input v-if="formEdit" v-on:click="cancel" type="button" id="cancel" class="button" value="Cancelar" />
					</div>
				</div>

			</form>
		</div>
	</div>
  `
})

jQuery(function($) {
	$(document).ready(function() {
		getAllFields();
		console.log(campos)
	});
});