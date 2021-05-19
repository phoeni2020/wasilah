<div class='btn-group btn-group-sm'>
    <a data-toggle="tooltip" data-placement="bottom" title="{{'edit car'}}" href="{{ url('car/data/'.$id) }}" class='btn btn-link'>
        <i class="fa fa-edit"></i>
    </a>
{!! Form::open(['url' => ["car/$id"], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}

</div>
