<h1>Новости "<?=$categoryTitle?>"</h1>
<?php foreach($newsList as $key => $news): ?>
    <div style="background:#ddd;border:1px solid #999;margin-top:20px;padding:10px 20px;">
        <h2><a href="<?=route('news.show', ['id' => $news['newsId']])?>"><?=$news['title']?></a></h2>
        <p><?=$news['author']?> - <?=$news['created_at']->format('d-m-Y H:i')?></p>
        <p><?=$news['description']?></p>
    </div>
<?php endforeach; ?>
<hr>
<div>
    <a href="<?=route('category.index')?>"
       style="background:#eee;border:1px solid #bbb;padding:5px 10px;"><< Назад к списку категорий</a>
</div>
