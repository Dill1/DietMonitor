<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Meals'), ['controller' => 'Meals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meal'), ['controller' => 'Meals', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="users view large-10 medium-9 columns">
    <h2><?= h($user->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($user->name) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($user->password) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
            <h6 class="subheader"><?= __('Exp Num Calories') ?></h6>
            <p><?= $this->Number->format($user->exp_num_calories) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Meals') ?></h4>
    <?php if (!empty($user->meals)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Calories') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->meals as $meals): ?>
        <tr>
            <td><?= h($meals->id) ?></td>
            <td><?= h($meals->user_id) ?></td>
            <td><?= h($meals->created) ?></td>
            <td><?= h($meals->description) ?></td>
            <td><?= h($meals->calories) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Meals', 'action' => 'view', $meals->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Meals', 'action' => 'edit', $meals->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Meals', 'action' => 'delete', $meals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meals->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
