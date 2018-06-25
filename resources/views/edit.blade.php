<div class="modal" id="taskEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="task">Task</label>
            <input type="text" class="form-control" id="text" v-model="taskEdit.keep" placeholder="Enter Task">
          </div>
          <button type="button" class="btn btn-primary" @click.prevent="update(taskEdit.id)">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>