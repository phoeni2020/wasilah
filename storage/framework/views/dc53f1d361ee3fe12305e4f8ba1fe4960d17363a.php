<div class='btn-group btn-group-sm'>
  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.destroy')): ?>
<?php echo Form::open(['url' => ['clinets/unban/'.$id], 'method' => 'put']); ?>

  <?php echo Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]); ?>

<?php echo Form::close(); ?>

  <?php endif; ?>
</div>
<?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/clints/datatable_actions_unban.blade.php ENDPATH**/ ?>