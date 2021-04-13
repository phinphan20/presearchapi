<?php
//PRESERACH API
$api_key = "PASTE_YOUR_PRESEARCH_API_KEY_HERE";
$url = 'https://nodes.presearch.org/api/nodes/status/'.$api_key.'?stats=true';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array(
   "Accept: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($curl);
curl_close($curl);
$presearch = json_decode($response,true);

//VULTR API
$vps_url = "https://api.vultr.com/v2/instances";
$vps_api = "PASTE_YOUR_PRESEARCH_API_KEY_HERE";
$vps_curl = curl_init($vps_url);
curl_setopt($vps_curl, CURLOPT_URL, $vps_url);
curl_setopt($vps_curl, CURLOPT_RETURNTRANSFER, true);
$vps_headers = array(
   "Accept: application/json",
	"Authorization: Bearer " . $vps_api
);
curl_setopt($vps_curl, CURLOPT_HTTPHEADER, $vps_headers);
$vps_response = curl_exec($vps_curl);
curl_close($vps_curl);
$vps = json_decode($vps_response,true);


foreach($presearch['nodes'] as $key=>$val)
	{
		$node_description = $val['meta']['description'];
		$remote_addr = $val['meta']['remote_addr'];
		$node_status = $val['status']['connected'];
		if ($node_status == 1)
			{
				$node_status = "<i class=\"fa fa-check text-success\"></i>&nbsp;Connected";
			}
		else
			{
				$node_status = "<i class=\"fa fa-times text-danger\"></i>&nbsp;Not Connected";
			}
		$minutes_in_current_state = $val['status']['minutes_in_current_state'];
		$minutes_in_current_state = (int)$minutes_in_current_state;
		$minutes_in_current_state = ($minutes_in_current_state);
		$gateway_pool = $val['meta']['gateway_pool'];
		$version = $val['meta']['version'];
		$total_uptime_seconds = $val['period']['total_uptime_seconds'];
		$total_uptime_seconds = convert_minutes($total_uptime_seconds);
		$in_current_state_since = $val['status']['in_current_state_since'];
		$in_current_state_since = $val['status']['in_current_state_since'];
		//gmdate($in_current_state_since);
		$date_time = gmdate('m/d/Y H:m:s',strtotime($in_current_state_since));
		$datetime1 = new DateTime();
		$datetime2 = new DateTime($date_time);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds'); //adds year to output
		$elapsed = $interval->format('%m months %a days %h hours %i minutes %s seconds');
		$uptime_percentage = $val['period']['uptime_percentage']; 
		$avg_latency_score = $val['period']['avg_latency_score'];
		$avg_latency_ms = $val['period']['avg_latency_ms'];
		$avg_uptime_score = $val['period']['avg_uptime_score'];
		$avg_reliability_score = $val['period']['avg_reliability_score'];
		$avg_staked_capacity_percent = $val['period']['avg_staked_capacity_percent'];
		$avg_utilization_percent = $val['period']['avg_utilization_percent'];
		$avg_staked_capacity_percent = sprintf('%f', floatval($avg_staked_capacity_percent));
		$avg_utilization_percent = sprintf('%f', floatval($avg_utilization_percent));
		
		//VULTR
		foreach($vps['instances'] as $vps_key=>$vps_val)
			{
				$main_ip = $vps_val['main_ip'];
				if ($remote_addr == $main_ip)
					{
						$label = $vps_val['label'];
						$power_status = $vps_val['power_status'];
						if ($power_status == "running")
							{
								$power_status = "<i class=\"fa fa-check text-success\"></i>&nbsp;Running";	
							}
						else
							{
								$power_status = "<i class=\"fa fa-times text-danger\"></i>&nbsp;Not Running";	
							}
						$vps_status = $vps_val['status'];
						if ($vps_status == "active")
							{
								$vps_status = "<i class=\"fa fa-check text-success\"></i>&nbsp;Active";
							}
						else
							{
								$vps_status = "<i class=\"fa fa-times text-danger\"></i>&nbsp;Not Active";
							}
						$server_status = $vps_val['server_status'];
						if ($server_status == "ok")
							{
								$server_status = "<i class=\"fa fa-check text-success\"></i>&nbsp;OK";
							}
						else
							{
								$server_status = "<i class=\"fa fa-times text-success\"></i>&nbsp;Not OK";
							}
						break;
					}
			}
	}
//COINMARKETCAP API
$cmc_url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
$cmc_parameters = [
  	'symbol' => 'PRE',
	'convert' => 'USD'
];
$cmc_headers = [
  'Accepts: application/json',
  'X-CMC_PRO_API_KEY: PASTE_YOUR_PRESEARCH_API_KEY_HERE'
];
$qs = http_build_query($cmc_parameters);
$cmc_request = "{$cmc_url}?{$qs}";
$cmc_curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($cmc_curl, array(
  CURLOPT_URL => $cmc_request,
  CURLOPT_HTTPHEADER => $cmc_headers,
  CURLOPT_RETURNTRANSFER => 1
));
$cmc_response = curl_exec($cmc_curl);
$cmc_response = json_decode($cmc_response,true);
$price = $cmc_response['data']['PRE']['quote']['USD']['price'];
$change = $cmc_response['data']['PRE']['quote']['USD']['percent_change_24h'];
if ($change >= 0)
	{
		$up_down = "<i class=\"fa fa-caret-up text-success\" aria-hidden=\"true\"></i>";
		$change = abs($change);
		$change = round($change,2);
		$price = "$".round($price,5)."&nbsp;&nbsp;".$up_down."<span class=\"text-danger\">".$change."%";
	}
else
	{
		$up_down = "<i class=\"fa fa-caret-down text-danger\" aria-hidden=\"true\"></i>";
		$change = abs($change);
		$change = round($change,2);
		$price = "$".round($price,5)."&nbsp;&nbsp;".$up_down."<span class=\"text-danger\">".$change."%";
	}

function convert_minutes($minutes) 
	{
		$dt1 = new DateTime("@0");
		$dt2 = new DateTime("@$minutes");
		return $dt1->diff($dt2)->format('%a days, %Hh:%Im:%Ss');
	}
?>