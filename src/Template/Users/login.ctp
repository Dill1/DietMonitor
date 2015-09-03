<div class="actions columns large-2 medium-3">
    <ul class="side-nav">
 
        <?= $this->Html->link(__('Create an account'), ['action' => 'add']) ?>
 
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Log In') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('password');
        ?>
        
    </fieldset>
    <?= $this->Form->button(__('Log In')) ?>
    <?= $this->Form->end() ?>
</div>
