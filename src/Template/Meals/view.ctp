<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Meal'), ['action' => 'edit', $meal->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Meal'), ['action' => 'delete', $meal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meal->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Meals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meal'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="meals view large-10 medium-9 columns">
    <h2><?= h($meal->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $meal->has('user') ? $this->Html->link($meal->user->name, ['controller' => 'Users', 'action' => 'view', $meal->user->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($meal->id) ?></p>
            <h6 class="subheader"><?= __('Calories') ?></h6>
            <p><?= $this->Number->format($meal->calories) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date') ?></h6>
            <p><?= h($meal->date) ?></p>
            <h6 class="subheader"><?= __('Time') ?></h6>
            <p><?= h($meal->time) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($meal->description)) ?>
        </div>
    </div>
</div>
