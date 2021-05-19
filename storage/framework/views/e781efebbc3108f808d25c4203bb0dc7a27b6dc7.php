<?php echo Form::open(['url' => ['drivers/destroy/'.$id], 'method' => 'delete']); ?>

 <?php echo Form::button('<i class="fa fa-trash"></i>', [
              'type' => 'submit',
              'class' => 'btn btn-link text-danger',
              'onclick' => "return confirm('Are you sure?')"
              ]); ?>

<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/drivers/datatables_actions.blade.php ENDPATH**/ ?>