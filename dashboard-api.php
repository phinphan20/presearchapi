<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Presearch API Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<!-- Font Awesome icons (free version)-->
	<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
require_once('inc/api.php');
?>
<div class="container-md">
	<div class="d-flex justify-content-center mt-3 mb-3"><strong>Presearch API Dashboard</strong></div>
	<div class="accordion" id="presearch-nodes">
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					<?php echo $node_description; ?>
				</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><strong>Node:</strong> <?php echo $node_description; ?></li>
						<li class="list-group-item"><strong>Node Status:</strong> <?php echo $node_status; ?></li>
						<li class="list-group-item"><strong>Version:</strong> <?php echo $version; ?></li>
						<li class="list-group-item"><strong>IP:</strong> <?php echo $remote_addr; ?></li>
						<li class="list-group-item"><strong>Connected:</strong> <?php echo $date_time." - ".$elapsed; ?></li>
						<li class="list-group-item"><strong>Gateway Pool:</strong> <?php echo $gateway_pool; ?></li>
						<li class="list-group-item"><strong>Uptime:</strong> <?php echo $total_uptime_seconds; ?></li>
						<li class="list-group-item"><strong>Uptime Score:</strong> <?php echo $avg_uptime_score; ?></li>
						<li class="list-group-item"><strong>Latency (ms):</strong> <?php echo $avg_latency_ms; ?></li>
						<li class="list-group-item"><strong>Latency Score:</strong> <?php echo $avg_latency_score; ?></li>
						<li class="list-group-item"><strong>Reliability Score:</strong> <?php echo $avg_reliability_score; ?></li>
						<li class="list-group-item"><strong>Staked %:</strong> <?php echo $avg_staked_capacity_percent ?></li>
						<li class="list-group-item"><strong>Utilization:</strong> <?php echo $avg_utilization_percent ?></li>
						<li class="list-group-item"><strong>Server Label:</strong> <?php echo $label; ?></li>
						<li class="list-group-item"><strong>Server Power Status:</strong> <?php echo $power_status; ?></li>
						<li class="list-group-item"><strong>Server Status:</strong> <?php echo $server_status; ?></li>
						<li class="list-group-item"><strong>Status:</strong> <?php echo $vps_status; ?></li>
						<li class="list-group-item"><strong>PRE Price:</strong> <?php echo $price; ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>