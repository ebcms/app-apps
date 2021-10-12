<?php

declare(strict_types=1);

namespace App\Ebcms\Apps\Http;

use App\Ebcms\Web\Http\Common;
use Ebcms\Template;
use Psr\SimpleCache\CacheInterface;

class Index extends Common
{
    public function get(
        CacheInterface $cache,
        Template $template
    ) {
        if (!$packages = $cache->get('packages')) {
            $res = json_decode(file_get_contents('https://packagist.org/search.json?type=ebcms-app'), true);
            $packages = $res['results'];
            $cache->set('packages', $packages, 3600);
        }
        return $template->renderFromFile('index@ebcms/apps', [
            'packages' => $packages,
        ]);
    }
}
