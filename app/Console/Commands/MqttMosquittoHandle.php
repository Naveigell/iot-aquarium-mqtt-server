<?php

namespace App\Console\Commands;

use App\Models\Detail;
use Illuminate\Console\Command;
use PhpMqtt\Client\Exceptions\DataTransferException;
use PhpMqtt\Client\Exceptions\InvalidMessageException;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\Exceptions\ProtocolViolationException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\Facades\MQTT;

class MqttMosquittoHandle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:mosquitto:subscribe {topic} {--qos=1} {--retain=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listener for topic in mosquitto';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws DataTransferException
     * @throws InvalidMessageException
     * @throws MqttClientException
     * @throws ProtocolViolationException
     * @throws RepositoryException
     */
    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe($this->argument('topic'), function (string $topic, string $message) {
            $data = json_decode($message, JSON_OBJECT_AS_ARRAY);

            Detail::create($data);

            echo "Received data of aquarium with temperature: " . $data['temperature'] . " and ph : " . $data['ph'] . " at " . date('Y-m-d H:i:s') . "\n";
        }, 1);
        $mqtt->loop();

        return Command::SUCCESS;
    }
}
