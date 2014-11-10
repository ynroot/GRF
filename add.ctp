<?php $userId = $this->Session->read('Auth.User.id');
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo __('Add Transaction'); ?></h3>
            </div>
            <div class="box-body table-responsive">

                <?php echo $this->Form->create('Transaction', array('role' => 'form')); ?>

                <fieldset>

                    <div class="form-group">
                        <?php echo $this->Form->input('user_id', array('value' => $userId, 'type' => 'hidden'), array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('transactions_type_id', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('account_id', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('valor', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('obs', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('categories_type_id', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('origins_destination_id', array('class' => 'form-control')); ?>
                    </div><!-- .form-group -->

                    <?php echo $this->Form->submit('Submit', array('class' => 'btn btn-large btn-primary')); ?>

                </fieldset>

                <?php echo $this->Form->end(); ?>

            </div><!-- /.form -->

        </div><!-- /#page-content .col-sm-9 -->

    </div><!-- /#page-container .row-fluid -->
