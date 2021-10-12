{include common/header@ebcms/apps}
{foreach $packages as $vo}
<div class="mb-3 pb-3 d-flex">
    <div>▪</div>
    <div class="ms-2">
        <div class="mb-2">
            <a href="{$router->buildUrl('/ebcms/apps/app',['name'=>$vo['name']])}" class="text-dark fw-light h5">{$vo.name}</a>
        </div>
        <div class="text-muted mb-1">
            <small>{$vo.description}</small>
        </div>
        <div class="text-muted">
            <small>下载：{$vo.downloads}</small>
            <small class="ms-2">收藏：{$vo.favers}</small>
        </div>
    </div>
</div>
{/foreach}
{include common/footer@ebcms/apps}