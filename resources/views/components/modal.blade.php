<a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#{{$idModal}}">{{ $btnTitle }}</a>

<div class="modal" id="{{$idModal}}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ $body }}</p>
      </div>
    </div>
  </div>
</div>