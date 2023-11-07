<?php
/**
 * Created by PhpStorm.
 * User: Silvio Leite
 * Date: 22/08/2018
 * Time: 19:13
 */

namespace laraPWA\Services;


class ManifestService
{
    public function generate()
    {
        $basicManifest =  [
            'name' => config('laraPWA.manifest.name'),
            'short_name' => config('laraPWA.manifest.short_name'),
            'start_url' => asset(config('laraPWA.manifest.start_url')),
            'display' => config('laraPWA.manifest.display'),
            'theme_color' => config('laraPWA.manifest.theme_color'),
            'background_color' => config('laraPWA.manifest.background_color'),
            'orientation' =>  config('laraPWA.manifest.orientation'),
            'status_bar' =>  config('laraPWA.manifest.status_bar'),
            'splash' =>  config('laraPWA.manifest.splash')
        ];

        foreach (config('laraPWA.manifest.icons') as $size => $file) {
            $fileInfo = pathinfo($file['path']);
            $basicManifest['icons'][] = [
                'src' => $file['path'],
                'type' => 'image/' . $fileInfo['extension'],
                'sizes' => (isset($file['sizes']))?$file['sizes']:$size,
                'purpose' => $file['purpose']
            ];
        }

        if (config('laraPWA.manifest.shortcuts')) {
            foreach (config('laraPWA.manifest.shortcuts') as $shortcut) {

                if (array_key_exists("icons", $shortcut)) {
                    $fileInfo = pathinfo($shortcut['icons']['src']);
                    $icon = [
                        'src' => $shortcut['icons']['src'],
                        'type' => 'image/' . $fileInfo['extension'],
                        'purpose' => $shortcut['icons']['purpose']
                    ];
                    if(isset($shortcut['icons']['sizes'])) {
                        $icon["sizes"] = $shortcut['icons']['sizes'];
                    }
                } else {
                    $icon = [];
                }

                $basicManifest['shortcuts'][] = [
                    'name' => trans($shortcut['name']),
                    'description' => trans($shortcut['description']),
                    'url' => $shortcut['url'],
                    'icons' => [
                        $icon
                    ]
                ];
            }
        }

        foreach (config('laraPWA.manifest.custom') as $tag => $value) {
             $basicManifest[$tag] = $value;
        }
        return $basicManifest;
    }

}
