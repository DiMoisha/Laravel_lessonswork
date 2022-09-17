<h1>Категории новостей:</h1>
<ul>
    <?php foreach($categories as $key => $category): ?>
        <li>
            <a href="<?=route('news.index', ['id' => $category['categoryId']])?>"><?=$category['title']?></a>
        </li>
    <?php endforeach; ?>
</ul>
<hr>
<div>
    <a href="/" style="background:#eee;border:1px solid #bbb;padding:5px 10px;">На главную</a>
</div>
