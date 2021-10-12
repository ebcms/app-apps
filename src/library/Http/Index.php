<?php

declare(strict_types=1);

namespace App\Ebcms\Apps\Http;

use App\Ebcms\Web\Http\Common;
use Ebcms\Template;

class Index extends Common
{
    public function get(
        Template $template
    ) {
        $res = json_decode(file_get_contents('https://packagist.org/search.json?type=ebcms-app'), true);
        return $template->renderFromFile('index@ebcms/apps', [
            'packages' => $res['results'],
        ]);
    }
}
