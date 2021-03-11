<ul class="nav__list container">
<?php foreach($cats as $v): ?>
    <li class="nav__item">
        <a href="/all-lots?cat=<?=$v['code']?>"><?=$v['name']?></a>
    </li>
<?php endforeach; ?>
</ul>
