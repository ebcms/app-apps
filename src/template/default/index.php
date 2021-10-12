<?php
$site = [
    'title' => '应用中心 - ' . $config->get('site.title@ebcms.web'),
    'keywords' => 'EBCMS应用中心',
    'description' => 'EBCMS应用中心',
];
?>
{include common/header@ebcms/apps}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li>当前位置：</li>
        <li class="breadcrumb-item"><a href="{:$router->buildUrl('/')}">主页</a></li>
        <li class="breadcrumb-item active">应用大全</li>
    </ol>
</nav>
{foreach $packages as $vo}
<div class="mb-3 p-3 border bg-light">
    <div class="mb-2">
        <a href="{$router->buildUrl('/ebcms/apps/app',['name'=>$vo['name']])}" class="text-dark h4">{$vo.name}</a>
    </div>
    <div class="mb-1 fw-light">
        {$vo.description}
    </div>
    <div class="text-muted">
        <small>下载：{$vo.downloads}</small>
        <small class="ms-2">收藏：{$vo.favers}</small>
    </div>
</div>
{/foreach}
{include common/footer@ebcms/apps}