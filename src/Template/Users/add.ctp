<div class="actions columns large-2 medium-3">
    <ul class="side-nav">
 
        Already have an account? 
        <?= $this->Html->link(__('Log In'), ['action' => 'login']) ?>
 
    </ul>
</div>
<div class="users form large-10 medium-9 columns">

<!-- echo $this->Form->create($article, ['action' => 'login']); -->

    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Create an account') ?></legend>

        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('password');
            echo $this->Form->input('exp_num_calories', ['label' => "Target Number of Calories Daily"]);
            ?>
        
    </fieldset>
    <?= $this->Form->button(__('Create')) ?>
    <?= $this->Form->end() ?>
</div>
