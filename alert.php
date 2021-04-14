<?php
//Check Node status
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

foreach($presearch['nodes'] as $key=>$val)
	{
		$node_description = $val['meta']['description'];
		$node_status = $val['status']['connected'];
		if ($node_status != 1)
			{
				$node_alert = $node_description." Alert ".$node_status;
				$date_time = gmdate('m/d/Y H:m:s',strtotime($in_current_state_since));
				$email_subject = $node_description." Alert";
				$email_body = "<br>".$node_alert."<br>".$date_time;
				require_once('email.php');
				require_once('text.php');
			}
	}

//CHECK SERVER STATUS
//VULTR API
$vps_url = "https://api.vultr.com/v2/instances";
$vps_api = "PASTE_YOUR_VULTR_API_KEY_HERE";
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

foreach($vps['instances'] as $vps_key=>$vps_val)
    {
		$label = $vps_val['label'];
		$power_status = $vps_val['power_status'];
		if ($power_status != "running")
			{
				$in_current_state_since = $val['status']['in_current_state_since'];
				$date_time = gmdate('m/d/Y H:m:s',strtotime($in_current_state_since));				
				$vps_alert = "Power Status Alert ". $label." ".$power_status;
				$email_subject = "VPS ".$label." Alert";
				$email_body = "<br>".$vps_alert."<br>".$date_time;
				$text_body = $vps_alert." ".$date_time;
				require_once('email.php');
				require_once('text.php');
			}
		$vps_status = $vps_val['status'];
		if ($vps_status != "active")
			{
				$in_current_state_since = $val['status']['in_current_state_since'];
				$date_time = gmdate('m/d/Y H:m:s',strtotime($in_current_state_since));
				$vps_alert = "VPS Status Alert ". $label." ".$vps_status;
				$email_subject = "VPS ".$label." Alert";
				$email_body = "<br>".$vps_alert."<br>".$date_time;
				$text_body = $vps_alert." ".$date_time;
				require_once('email.php');
				require_once('text.php');
			}
		$server_status = $vps_val['server_status'];
		if ($server_status != "ok")
			{
				$in_current_state_since = $val['status']['in_current_state_since'];
				$date_time = gmdate('m/d/Y H:m:s',strtotime($in_current_state_since));
				$vps_alert = "Server Status Alert ". $label." ".$server_status;
				$email_subject = "VPS ".$label." Alert";
				$email_body = "<br>".$vps_alert."<br>".$date_time;
				$text_body = $vps_alert." ".$date_time;
				require_once('email.php');
				require_once('text.php');
			}
    }
?>