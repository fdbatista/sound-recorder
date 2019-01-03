<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SoundRecorderAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'plugins/sound-recorder/bootstrap.min.js',
        'plugins/sound-recorder/WebAudioRecorder.min.js',
        'plugins/sound-recorder/init.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];

}
