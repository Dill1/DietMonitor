

<h1>
    Meals entered between <?= date("M/d/Y h:m:s",$from) ?> and <?= date("M/d/Y h:m:s", $to) ?>
</h1>

<section>
<?php foreach ($meals as $meal): ?>
    <article>
    	<h4><?= $meal->description ?></h4>
    </article>
<?php endforeach; ?>
</section>