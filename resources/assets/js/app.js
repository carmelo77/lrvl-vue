new Vue({
    el: '#app',
    data: {
    	keeps: [],
    	url: 'tasks',
    	task: {
    		keep: '',
    	},
    	taskEdit: {
    		id: '',
    		keep: '',
    	},
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0,
        },
        offset: 2 //Offset significa literalmente compensación.
    },

    created() {
    	this.index();
    },

    computed: {
        isActived() {
            return this.pagination.current_page; //Función para la pagina actual.
        },

        pagesNumber() {
            if(!this.pagination.to) { //Si no hay pagina adonde ir (Más de una) retorna array vacío.
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1) { //Si "from" es menor a 1, no se puede. No existe una página menor a 1.
                from = 1; //Así que siempre será 1.
            }

            var to = from + (this.offset * 2); 

            if(to >= this.pagination.last_page) { //Si "to" es mayor, al maximo de páginas que existe en laravel.
                to = this.pagination.last_page; //Le decimos que el maximo es el q dice laravel.
            }

            let pageArray = []; //Definimos las paginas en un array.

            while (from <= to) { //Recorremos "from" hasta que llegue a la ultima en "to"
                pageArray.push(from); //Mientras recorre, la añadimos al pagesArray.
                from++; //Y aumentamos el numero de páginas que va avanzando en from.
            }

            return pageArray; //Por último, retornamos la data del n° de páginas guardada en pagesArray.
        }
    },

    methods: {
    	index(page) {
    		axios.get(this.url + '?page=' + page)
    			.then(response => {
    				this.keeps = response.data.tasks.data;
                    this.pagination = response.data.paginate;
    			});
    	},

    	save() {
    		axios.post(this.url, this.task)
    			.then(response => {
    				toastr.options.closeButton = true;
    				toastr.success(response.data.success);
    				this.task = {};
    				$('#taskModal').modal('hide');
    				this.index();
    			});
    	},

    	edit(keep) {
    		axios.get(this.url + '/' + keep.id + '/edit')
    			.then(response => {
    				this.taskEdit.id = response.data.id;
    				this.taskEdit.keep = response.data.keep;
    			});
    	},

    	update(id) {
    		axios.put(this.url + '/' + id, this.taskEdit)
    			.then(response => {
    				toastr.options.closeButton = true;
    				toastr.success(response.data.success);
    				$('#taskEdit').modal('hide');
    				this.index();
    			});
    	},

    	destroy(id) {
    		axios.delete(this.url + '/' + id)
    			.then(response => {
    				toastr.options.closeButton = true;
    				toastr.success(response.data.success);
    				this.index();
    			})
    	},

        changePage(page) {
            this.pagination.current_page = page;
            this.index(page);
        }
    }
});
