<div class='btn-group btn-group-sm'>
  @can('users.destroy')
{!! Form::open(['url' => ['clinets/unban/'.$id], 'method' => 'put']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
