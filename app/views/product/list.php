<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sortfirst'>
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'price_ASC' ? 'selected' : '';?> value="price_ASC">від дешевших до дорожчих</option>
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'price_DESC' ? 'selected' : '';?> value="price_DESC">від дорожчих до дешевших</option>
</select>
<select name='sortsecond'>
  <option <?php echo filter_input(INPUT_POST, 'sortsecond') === 'qty_ASC' ? 'selected' : '';?>  value="qty_ASC">по зростанню кількості</option>
  <option <?php echo filter_input(INPUT_POST, 'sortsecond') === 'qty_DESC' ? 'selected' : '';?>  value="qty_DESC">по спаданню кількості</option>
</select>
<input type="submit" value="Submit">
</form>

<?php if (Helper::isAdmin()):?>
    <div class="product"><p>
            <?php echo Helper::simpleLink('/product/add', 'Додати товар'); ?>
    </div>
<?php endif;?>


<?php

$products =  $this->registry['products'];

foreach($products as $product)  :
?>

    <div class="product">
        <p class="sku">Код: <?php echo $product['sku']?></p>
        <h4><?php echo $product['name']?><h4>
        <p> Ціна: <span class="price"><?php echo $product['price']?></span> грн</p>
        <p> Кількість: <?php echo $product['qty']?></p>
        <p>Опис : <?php echo htmlspecialchars_decode($product['description'])?></p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <?php if (Helper::isAdmin()):?>
            <p>
                <?php echo Helper::simpleLink('/product/edit', 'Редагувати', array('id'=>$product['id'])); ?>
                <span style="background-color: orangered; font-size: 15px"><?php echo Helper::simpleLink('/product/delete', 'Видалення', array('id'=>$product['id'])); ?></span>
            </p>
        <?php endif;?>
    </div>
<?php endforeach; ?>

