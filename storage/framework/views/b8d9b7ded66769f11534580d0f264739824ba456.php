<div class='btn-group btn-group-sm'>
    <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('lang.user_edit')); ?>" href="<?php echo e(url("clint/admin/edit/$id")); ?>" class='btn btn-link'>
        <i class="fa fa-edit"></i>
    </a>
  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.destroy')): ?>
<?php echo Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']); ?>

  <?php echo Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]); ?>

<?php echo Form::close(); ?>

  <?php endif; ?>
</div>
<?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/clints/datatables_actions.blade.php ENDPATH**/ ?>