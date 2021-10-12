<?php
$site = [
    'title' => '应用中心 - ' . $config->get('site.title@ebcms.web'),
    'keywords' => 'EBCMS应用中心',
    'description' => 'EBCMS应用中心',
];
?>
{include common/header@ebcms/apps}
<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li>当前位置：</li>
            <li class="breadcrumb-item"><a href="{:$router->buildUrl('/')}">主页</a></li>
            <li class="breadcrumb-item active">应用大全</li>
        </ol>
    </nav>
    {foreach $packages as $package}
    <div class="mb-3 p-3 border bg-light">
        <div class="mb-2">
            <a href="{$router->buildUrl('/ebcms/apps/app',['vendor'=>substr($package['name'], 0 ,strpos($package['name'], '/')), 'package'=>substr($package['name'], strpos($package['name'], '/')+1)])}" class="text-dark h4">{$package.name}</a>
        </div>
        <div class="mb-1 fw-light">
            {$package.description}
        </div>
        <div class="text-muted">
            <small>下载：{$package.downloads}</small>
            <small class="ms-2">收藏：{$package.favers}</small>
        </div>
    </div>
    {/foreach}
</div>
{include common/footer@ebcms/apps}