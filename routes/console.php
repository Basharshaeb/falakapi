<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Models\LocationHistory;
use App\Models\User;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



Schedule::call(function () {
    // DB::table('recent_users')->delete();
    $client = new Client();

    try {
        // Make a GET request to the API with an Authorization header
        $response = $client->get('https://portal.oqtec.com/api/plugins/telemetry/DEVICE/888eb2c0-0958-11ef-bef7-5131a0fcf1e6/values/timeseries?&startTs=1714477692&endTs=1715003283', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJ0b290YWE4NTlAZ21haWwuY29tIiwidXNlcklkIjoiMzM0MDA2ZjAtMGE0NS0xMWVmLWJlZjctNTEzMWEwZmNmMWU2Iiwic2NvcGVzIjpbIkNVU1RPTUVSX1VTRVIiXSwic2Vzc2lvbklkIjoiNmJmZDJkZDktNDVhNy00Nzc1LThjNmEtZDk5YjA1YTBhOTBmIiwiaXNzIjoidGhpbmdzYm9hcmQuY2xvdWQiLCJpYXQiOjE3MTYyNDQ4NDUsImV4cCI6MTcxNjI3MzY0NSwiZmlyc3ROYW1lIjoiRmF0bWEiLCJlbmFibGVkIjp0cnVlLCJpc1B1YmxpYyI6ZmFsc2UsImlzQmlsbGluZ1NlcnZpY2UiOmZhbHNlLCJwcml2YWN5UG9saWN5QWNjZXB0ZWQiOnRydWUsInRlcm1zT2ZVc2VBY2NlcHRlZCI6dHJ1ZSwidGVuYW50SWQiOiJhZjQzNjczMC1jY2FlLTExZWUtYTlhNC0xNTQzMWMyMGIxZjkiLCJjdXN0b21lcklkIjoiMTgyMzNmYjAtMDk1OC0xMWVmLWJlZjctNTEzMWEwZmNmMWU2In0.t3DjCKp2lnRnxBpNvC4nwvGJ6xeGUsH9axtn7uA7HHRCYnZqMOLP-bEasV11lEyUzx-CdPMo91ybwlsNUHKmLQ',
            ],
        ]);

        // Decode the JSON response
        $data = json_decode($response->getBody()->getContents(), true);

        // Save the sensor data to the database
       
        $sensorData = new LocationHistory([
            'date_time' => now(),
            // 'temperature' => $data['temperature'][0]['value'],
            'latitude' => $data['lat'][0]['value'],
            'longitude' => $data['lng'][0]['value'],
            'user_id'=>2,
            'source' =>'device',
            // 'sensor_id' => $data['sensorID'][0]['value'],
            // 'heading' => $data['heading'][0]['value'],
            // 'velocity' => $data['velocity'][0]['value'],
            // 'terminal_id' => $data['terminalID'][0]['value'],
        ]);
        $user=User::find(2);
        if($user){
            $user->latitude=$sensorData->latitude;
            $user->longitude=$sensorData->longitude;
$user->save;
        }

        $sensorData->save();

        $this->info('Sensor data saved successfully.');
    } catch (\Exception $e) {
        $this->error('Failed to fetch or save sensor data: ' . $e->getMessage());
    }

})->everyMinute();
