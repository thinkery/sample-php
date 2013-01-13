<?php

include __DIR__ . "/config.php";
include __DIR__ . "/lib/OAuth2Client.php";
include __DIR__ . "/lib/thinkery-api-client.php";

$api = new ThinkeryApi(THINKERY_API_CLIENT_ID, THINKERY_API_CLIENT_SECRET);
?><html>
	<head>
		<title>Add a new thing to your Thinkery</title>
	</head>
	<body>
		<h1>Add a new thing to your Thinkery</h1>
		<?php
			$session = $api->getSession();
			if (!$session) {
				if (isset($_GET["error"])) {
					echo $_GET["error"];
					exit;
				}

				?><p>You need to authorize this app to add something to your thinkery. <a href="<?php echo $api->getLoginUri(); ?>">Do this by visiting this link and allowing access.</a></p><?php
			} elseif (!empty($_POST) && isset($_POST["thing"])) {
				$result = $api->api("/thing/add", "POST", array(
					"title" => $_POST["thing"],
				));
				if (isset($result)) {
					?><p>The new thing has been saved with the id <?php echo htmlspecialchars($result["_id"]); ?>.</p><?php
				} else {
					?><p>There was an error saving the thing: <?php var_dump($result); ?></p><?php
				}
			} else {
				$user = $api->api('/user/get');
				?><form method="post">
				<p>Welcome <?php echo htmlspecialchars($user["username"]); ?>!</p>
				<p>Add a new thing to your thinkery here:</p>
				<input type="text" name="thing" value="" />
				<button>Save</button>
				</form><?php
			}
		?>
	</body>
</html>
