var service = info.ecw_url;

var list = new Vue({
  el: '#app',
  data: function() {
  	return {
  		//Form
	  	formTitle: 'Agregar campo',
	  	formBtn: 'Agregar',
	  	formEdit: false,
	  	field: {
	  		name: '',
		  	label: '',
		  	placeholder: '',
		  	type: '',
		  	id: '',
		  	class: '',
		  	columns: '0',
	  	},
	  	fieldList: [],

	  	//Services
	  	serviceUrl: service
  	}
  },
  methods: {
  	save: function() {

  		if(this.formEdit) {

  			let obj = this.fieldList.filter(field => field.name == this.field.name );
  			obj[0] = this.field;
  			this.field = { name: '', label: '', placeholder: '', type: '', id: '', class: '', columns: '0' }
  			this.formEdit = false;
	    	this.formTitle = 'Agregar campo';
	    	this.formBtn = 'Agregar';

  		} else {
  			this.fieldList.push(this.field)
  			this.field = { name: '', label: '', placeholder: '', type: '', id: '', class: '', columns: '0' }
  		}

    },
    changeAction: function(field) {
    	this.formEdit = true;
    	this.formTitle = 'Modificar campo: ' + field.name;
    	this.formBtn = 'Actualizar';

    	this.field = field;
    },
    cancel: function() {
    	this.formEdit = false;
    	this.formTitle = 'Agregar campo';
    	this.formBtn = 'Agregar';
    	this.field = { name: '', label: '', placeholder: '', type: '', id: '', class: '', columns: '0' }
    }
  },
  template: `
  	<div class="row">
  		<div class="col-12 col-md-5">
  			<h5 class="section-title">Campos del formulario ({{fieldList.length}}):</h5>
			<ul class="fields-list">
				<li v-for="item in fieldList" :key="item.name">
					<p class="name">{{item.label}}</p>
					<p class="type">Tipo de campo: <b>{{item.type}}</b></p>
					<a v-on:click="changeAction(item)" class="editar">
						<i class="fas fa-edit"></i> Editar
					</a>
				</li>
			</ul>
		</div>

		<div class="col-12 col-md-7">
			<h5 class="section-title">{{formTitle}}</h5>
			<form id="form-fields" class="form-fields">
				
				<div class="row">
					<div class="form-group col-12">
						<label for="label_field">Etiqueta del campo:</label>
						<input type="text" name="label_field" id="label_field" class="form-control" placeholder="Etiqueta del campo..." v-model="field.label">
					</div>

					<div class="form-group col-12">
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-text" v-on:click="field.type = 'text'" v-model="field.type" value="text" />
							<label for="type-text">Texto</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-email" v-on:click="field.type = 'email'" v-model="field.type" value="email" />
							<label for="type-email">Correo electrónico</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-textarea" v-on:click="field.type = 'textarea'" v-model="field.type" value="textarea" />
							<label for="type-textarea">Área de texto</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" name="type" id="type-select" v-on:click="field.type = 'select'" v-model="field.type" value="select" />
							<label for="type-select">Lista desplegable</label>
						</div>
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="name_field">Name del campo:</label>
						<input type="text" name="name_field" id="name_field" class="form-control" placeholder="Name del campo..." v-model="field.name">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="placeholder_field">Placeholder del campo:</label>
						<input type="text" name="placeholder_field" id="placeholder_field" class="form-control" placeholder="Texto de ejemplo" v-model="field.placeholder">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="id_field">ID del campo:</label>
						<input type="text" name="id_field" id="id_field" class="form-control" placeholder="id-de-ejemplo" v-model="field.id">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="class_field">Clase del campo:</label>
						<input type="text" name="class_field" id="class_field" class="form-control" placeholder="clase-de-ejemplo" v-model="field.class">
					</div>

					<div class="form-group col-12 col-md-6">
						<label for="columns_field">Columnas del campo:</label>
						<select name="columns_field" id="columns_field" v-model="field.columns">
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