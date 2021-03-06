<?php

declare(strict_types=1);

namespace App\Ebcms\Apps\Http;

use App\Ebcms\Web\Http\Common;
use Ebcms\Request;
use Ebcms\Template;
use Parsedown;
use Psr\SimpleCache\CacheInterface;
use ZipArchive;

class App extends Common
{
    public function get(
        Request $request,
        Template $template,
        CacheInterface $cache,
        Parsedown $parsedown
    ) {
        if (!$package = $cache->get('package.' . $request->get('vendor') . '.' . $request->get('package'))) {
            $res = json_decode(file_get_contents('https://packagist.org/packages/' . $request->get('vendor') . '/' . $request->get('package') . '.json'), true);
            $package = $res['package'];
            $cache->set('package.' . $request->get('vendor') . '.' . $request->get('package'), $package, 3600);
        }

        if ($package['type'] != 'ebcms-app') {
            return $this->failure('应用不存在~');
        }

        if (!$readme = $cache->get('readme.' . $request->get('vendor') . '.' . $request->get('package'))) {
            $last = current($package['versions']);
            if ($last['dist']['type'] == 'zip') {
                $readme = $this->getZipContentFromUrl($last['dist']['url']);
                $cache->set('readme.' . $request->get('vendor') . '.' . $request->get('package'), $readme, 3600);
            }
        }

        $parsedown->setMarkupEscaped(false);

        return $template->renderFromFile('app@ebcms/apps', [
            'package' => $package,
            'readme' => $parsedown->text($readme),
        ]);
    }

    private function getZipContentFromUrl($url): ?string
    {
        $zip = new ZipArchive();
        $tmpfile = tempnam(sys_get_temp_dir(), uniqid());
        $content = $this->curlGet($url);
        file_put_contents($tmpfile, $content);
        if ($zip->open($tmpfile)) {

            if (!$fp = $zip->getStream($zip->getNameIndex(0) . 'README.md')) {
                if (!$fp = $zip->getStream($zip->getNameIndex(0) . 'README')) {
                    return null;
                }
            }

            $contents = '';
            while (!feof($fp)) {
                $contents .= fread($fp, 2);
            }
            fclose($fp);

            return $contents;
        }
    }

    private function curlGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL,  $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36');
        $data = curl_exec($ch);
        return $data;
    }
}
