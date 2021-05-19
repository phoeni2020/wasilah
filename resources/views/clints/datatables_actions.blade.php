<div class='btn-group btn-group-sm'>
    <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.user_edit')}}" href="{{ url("clint/admin/edit/$id") }}" class='btn btn-link'>
        <i class="fa fa-edit"></i>
    </a>
  @can('users.destroy')
{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
