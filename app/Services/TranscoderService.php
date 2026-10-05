<?php

namespace App\Services;

use Aws\ElasticTranscoder\ElasticTranscoderClient;

class TranscoderService
{
    protected $transcoder = null;

    public function __construct()
    {
        $key = env('AWS_ACCESS_KEY_ID');
        $secret = env('AWS_SECRET_ACCESS_KEY');
        $region = env('AWS_DEFAULT_REGION', 'ap-south-1');

        if (!empty($key) && !empty($secret)) {
            try {
                $this->transcoder = new ElasticTranscoderClient([
                    'region'  => $region,
                    'version' => 'latest',
                    'credentials' => [
                        'key'    => $key,
                        'secret' => $secret,
                    ],
                    'http' => [
                        'timeout'         => 8,
                        'connect_timeout' => 4,
                    ],
                ]);
            } catch (\Exception $e) {
                \Log::warning('TranscoderClient init failed: ' . $e->getMessage());
                $this->transcoder = null;
            }
        }
    }

    public function createJob($inputKey, $outputKey, $presetId)
    {
        $pipelineId = env('AWS_TRANSCODER_PIPELINE_ID');

        if (!$this->transcoder || empty($pipelineId)) {
            return null;
        }

        try {
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
        } catch (\Exception $e) {
            \Log::warning('Transcoder createJob failed: ' . $e->getMessage());
            return null;
        }
    }
}
