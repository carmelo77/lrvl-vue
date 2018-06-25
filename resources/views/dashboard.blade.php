@extends('layout')

@section('content')

	<div class="col-md-12">
		<h3 class="text-center text-success">
			App Laravel + Vue
		</h3>
	</div>

	<div id="app" class="row">
		<div class="col-md-12">
			<h3 class="border-bottom-2 text-primary">
				CRUD Laravel y VueJs
			</h3>
		</div>
		<div class="col-md-7">
			@component('components.modal')
				@slot('btnTitle', 'New Task')
					
				@slot('idModal', 'taskModal')		

				@slot('title', 'Create a new task')
					
				@slot('body')
					<form>
					  <div class="form-group">
					    <label for="task">Task</label>
					    <input type="text" class="form-control" id="text" v-model="task.keep" placeholder="Enter Task">
					  </div>
					  <button type="button" class="btn btn-primary" @click.prevent="save()">Save</button>
					</form>
				@endslot
			
			@endcomponent

			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Task</th>
						<th colspan="2">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="keep in keeps" :key="keep.id">
						<td>@{{ keep.id }}</td>
						<td>@{{ keep.keep }}</td>
						<td>
							<a href="#" class="btn btn-warning btn-sm" @click="edit(keep)" data-toggle="modal" data-target="#taskEdit">Edit</a>
							@include('edit')
						</td>
						<td>
							<a href="#" class="btn btn-danger btn-sm" @click.prevent="destroy(keep.id)">Delete</a>
						</td>
					</tr>
				</tbody>
			</table>

			<nav aria-label="Page navigation example">
			  <ul class="pagination">
			    <li class="page-item"><a class="page-link" href="#" v-if="pagination.current_page > 1" @click.prevent="changePage(pagination.current_page - 1)">Previous</a></li>
			    <li class="page-item" v-for="page in pagesNumber" :class="[page == isActived ? 'active' : '']">
			    	<a class="page-link" href="#" @click.prevent="changePage(page)">
			    		@{{ page }}
			    	</a>
			    </li>
			    <li class="page-item"><a class="page-link" href="#" v-if="pagination.current_page < pagination.last_page" @click.prevent="changePage(pagination.current_page + 1)">Next</a></li>
			  </ul>
			</nav>
		</div>
		<div class="col-md-5">
			<pre>
				@{{ $data }}
			</pre>
		</div>
	</div>
@endsection