<?php

namespace Google\Cloud\Samples\Dlp;

use Google\Cloud\Dlp\V2\Client\DlpServiceClient;
use Google\Cloud\Dlp\V2\CreateDlpJobRequest;
use Google\Cloud\Dlp\V2\InspectConfig;
use Google\Cloud\Dlp\V2\InspectJobConfig;
use Google\Cloud\Dlp\V2\Likelihood;
use Google\Cloud\Dlp\V2\ListInfoTypesRequest;
use Google\Cloud\Dlp\V2\StorageConfig;

// Instantiate a client.
$dlp = new DlpServiceClient();

// optional args array (variable)
$request = (new ListInfoTypesRequest());
$infoTypes = $dlp->listInfoTypes($request);

// optional args array (inline array)
$options = ['jobId' => 'abc', 'locationId' => 'def'];
$request2 = (new CreateDlpJobRequest())
    ->setParent($parent)
    ->setJobId($options['jobId'])
    ->setLocationId($options['locationId']);
$job = $dlp->createDlpJob($request2);

// optional args array (inline with nested arrays)
$options2 = [
    'inspectJob' => new InspectJobConfig([
        'inspect_config' => (new InspectConfig())
            ->setMinLikelihood(likelihood::LIKELIHOOD_UNSPECIFIED)
            ->setLimits($limits)
            ->setInfoTypes($infoTypes)
            ->setIncludeQuote(true),
        'storage_config' => (new StorageConfig())
            ->setCloudStorageOptions(($cloudStorageOptions))
            ->setTimespanConfig($timespanConfig),
    ])
];
$request3 = (new CreateDlpJobRequest())
    ->setParent($parent)
    ->setInspectJob($options2['inspectJob']);
$job = $dlp->createDlpJob($request3);
