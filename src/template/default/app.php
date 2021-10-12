<?php
$site = [
    'title' => $package['name'] . ' - 应用中心 - ' . $config->get('site.title@ebcms.web'),
    'keywords' => $package['name'],
    'description' => $package['description'],
];
?>
{include common/header@ebcms/apps}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li>当前位置：</li>
        <li class="breadcrumb-item"><a href="{:$router->buildUrl('/')}">主页</a></li>
        <li class="breadcrumb-item"><a href="{:$router->buildUrl('/ebcms/apps/index')}">应用大全</a></li>
        <li class="breadcrumb-item active">{$package.name}</li>
    </ol>
</nav>
<script src="https://cdn.bootcdn.net/ajax/libs/highlight.js/10.1.1/highlight.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@10.1.2/styles/vs.css">
<script>
    $(function() {
        $(".content table").addClass("table");
        $(".content a").addClass("px-2").append('<svg t="1595730969467" class="icon ms-1" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3841" width="15" height="15"><path d="M719.168 207.168L576 64h384v384l-150.272-150.272-264.128 264.064-90.496-90.496 264.064-264.128zM192 960H64V64h384v128H192v640h640V576h128v384H192z" fill="#007bff" p-id="3842"></path></svg>').attr('target', '_blank');
        $.each($(".content code"), function(index, ele) {
            if ($(ele).parents("pre").length == 0) {
                $(ele).addClass("mx-1");
            }
        });
        $("#navbar").show();
    });
    hljs.initHighlightingOnLoad();
</script>
<style>
    a {
        text-decoration: none;
    }

    .content pre>code {
        padding: 15px !important;
        background: #f6f8fa !important;
    }

    .content h2 {
        padding: 10px 0;
    }

    .content h3 {
        padding: 8px 0;
    }

    .content h4 {
        padding: 5px 0;
    }
</style>
<div class="mb-3 p-3 border bg-light">
    <div class="mb-2">
        <a href="{$router->buildUrl('/ebcms/apps/app',['name'=>$package['name']])}" class="text-dark h4">{$package.name}</a>
    </div>
    <div class="mb-1 fw-light">
        {$package.description}
    </div>
    <div class="text-muted">
        <small>下载：{$package.downloads.total}</small>
        <small class="ms-2">收藏：{$package.favers}</small>
    </div>
</div>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-readme-tab" data-bs-toggle="tab" data-bs-target="#nav-readme" type="button" role="tab" aria-controls="nav-readme" aria-selected="true">介绍</button>
        <button class="nav-link" id="nav-version-tab" data-bs-toggle="tab" data-bs-target="#nav-version" type="button" role="tab" aria-controls="nav-version" aria-selected="false">更新记录</button>
        <button class="nav-link" id="nav-install-tab" data-bs-toggle="tab" data-bs-target="#nav-install" type="button" role="tab" aria-controls="nav-install" aria-selected="false">如何安装</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-readme" role="tabpanel" aria-labelledby="nav-readme-tab">
        <div class="content mt-3">
            {echo $readme}
        </div>
    </div>
    <div class="tab-pane fade" id="nav-version" role="tabpanel" aria-labelledby="nav-version-tab">
        <div class="mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>版本</th>
                        <th>日期</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $package['versions'] as $version => $vo}
                    <tr>
                        <td>{$version}</td>
                        <td>{$vo.time}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-install" role="tabpanel" aria-labelledby="nav-install-tab">
        <div class="content mt-3">
            <h4>第一步：创建项目</h4>
            <pre><code>composer create-project ebcms/project</code></pre>
            <div class="alert alert-warning">若已经创建过，则不必可以跳过该步骤</div>
            <h4>第二步：安装本应用</h4>
            <div>进入创建的项目目录，执行下面的代码安装该应用：</div>
            <pre><code>composer require {$package.name}</code></pre>
            <h4 class="text-muted">（完毕）</h4>
        </div>
    </div>
</div>

{include common/footer@ebcms/apps}