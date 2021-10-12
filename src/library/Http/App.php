<?php

declare(strict_types=1);

namespace App\Ebcms\Apps\Http;

use App\Ebcms\Web\Http\Common;
use Ebcms\Request;
use Ebcms\Template;

class App extends Common
{
    public function get(
        Request $request,
        Template $template
    ) {
        $res = json_decode(file_get_contents('https://repo.packagist.org/p2/' . $request->get('name') . '.json'), true);
        return $template->renderFromFile('app@ebcms/apps', [
            'package' => $res['packages'],
        ]);
    }
}
