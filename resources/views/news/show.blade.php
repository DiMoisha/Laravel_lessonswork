<h1><?=$news['title']?></h1>
<div style="background:#ddd;border:1px solid #999;margin-top:20px;padding:20px;">
    <p><?=$news['author']?> - <?=$news['created_at']->format('d-m-Y H:i')?></p>
    <p><?=$news['description']?></p>
</div>
<hr>
<div>
    <a href="<?=route('news.index', ['id' => $news['categoryId']])?>"
       style="background:#eee;border:1px solid #bbb;padding:5px 10px;"><< Назад к списку новостей</a>
</div>
