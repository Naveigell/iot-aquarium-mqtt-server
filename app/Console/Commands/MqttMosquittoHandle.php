<?php

namespace App\Console\Commands;

use App\Models\Detail;
use App\Models\Drain;
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
        $topic = $this->argument('topic');

        $mqtt = MQTT::connection();
        $mqtt->subscribe($topic, function (string $topic, string $message) {
            if ($topic == '/aquarium/detail/publish') {
                $this->handleAquariumData($topic, $message);
            } else if ($topic == '/aquarium/drain/publish') {
                $this->handleAquariumDrain($topic, $message);
            }
        }, 1);
        $mqtt->loop();

        return Command::SUCCESS;
    }

    /**
     * Handles the aquarium data received from a topic.
     *
     * @param string $topic The topic from which the data is received.
     * @param string $message The data received.
     * @return void
     */
    private function handleAquariumData(string $topic, string $message)
    {
        $data = json_decode($message, JSON_OBJECT_AS_ARRAY);

        Detail::create($data);

        echo "Received data of aquarium with temperature: " . $data['temperature'] . " and ph : " . $data['ph'] . " at " . date('Y-m-d H:i:s') . "\n";
    }

    /**
     * Handles the aquarium drain.
     *
     * @param string $topic The topic of the aquarium drain.
     * @param string $message The message associated with the aquarium drain.
     * @return void
     */
    private function handleAquariumDrain(string $topic, string $message)
    {
        Drain::create();

        echo "Received data of aquarium drain at: " . date('Y-m-d H:i:s') . "\n";
    }
}
