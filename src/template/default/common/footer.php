</div>
<div class="container-xxl d-print-none">
    <div class="pt-3 pb-5 d-flex justify-content-between text-muted" style="font-size: .8em;">
        <div>
            <div class="mb-1">Copyright ©1998-{:date('Y')} {$config->get('site.name@ebcms/web')}. All Rights Reserved. 版权所有 侵权必究</div>
            <div class="mb-1"><a href="https://beian.miit.gov.cn/#/Integrated/index" target="_blank">{$config->get('site.beian@ebcms/web')}</a></div>
            <div class="mb-1">Powered By <a href="http://www.ebcms.com" target="_blank">EBCMS</a>. <a href="{$router->buildUrl('/ebcms/admin/index')}" class="text-muted ms-1">进入后台</a></div>
        </div>
    </div>
</div>
</body>

</html>