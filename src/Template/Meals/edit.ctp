<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $meal->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $meal->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Meals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="meals form large-10 medium-9 columns">
    <?= $this->Form->create($meal) ?>
    <fieldset>
        <legend><?= __('Edit Meal') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('date');
            echo $this->Form->input('time');
            echo $this->Form->input('description');
            echo $this->Form->input('calories');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
