{!! Form::open(['url' => ['drivers/destroy/'.$id], 'method' => 'delete']) !!}
 {!! Form::button('<i class="fa fa-trash"></i>', [
              'type' => 'submit',
              'class' => 'btn btn-link text-danger',
              'onclick' => "return confirm('Are you sure?')"
              ]) !!}
{!! Form::close() !!}
