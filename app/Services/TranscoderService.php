<?php

namespace App\Services;

use Aws\ElasticTranscoder\ElasticTranscoderClient;

class TranscoderService
{
    protected $transcoder;

    public function __construct()
    {
        $this->transcoder = new ElasticTranscoderClient([
            'region'  => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    public function createJob($inputKey, $outputKey, $presetId)
    {
        $pipelineId = env('AWS_TRANSCODER_PIPELINE_ID');

        $job = $this->transcoder->createJob([
            'PipelineId' => $pipelineId,
            'Input' => [
                'Key' => $inputKey,
            ],
            'Outputs' => [
                [
                    'Key' => $outputKey,
                    'PresetId' => $presetId,
                ],
            ],
        ]);

        return $job;
    }
}
