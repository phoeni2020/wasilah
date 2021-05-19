<div class='btn-group btn-group-sm'>
    <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e('edit car'); ?>" href="<?php echo e(url('car/data/'.$id)); ?>" class='btn btn-link'>
        <i class="fa fa-edit"></i>
    </a>
<?php echo Form::open(['url' => ["car/$id"], 'method' => 'delete']); ?>

  <?php echo Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]); ?>

<?php echo Form::close(); ?>


</div>
<?php /**PATH /opt/lampp/htdocs/Back_End/resources/views/car/datatables_actions.blade.php ENDPATH**/ ?>