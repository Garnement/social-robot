<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php dump($robots); ?>

    <?php foreach ($robots as $robot): ?>
      <h2><a href="<?php echo $robot->id; ?>"><?php echo $robot->name; ?></a></h2>
      <img src="<?php echo url('images', $robot->link); ?>">
      <ul>
        <li>Nom: <?php echo $robot->name; ?></li>
        <li>Catégorie: <?php echo $robot->category->title; ?></li>
        <li>Description: <?php echo $robot->description; ?></li>
      </ul>
    <?php endforeach; ?>
  </body>
</html>
