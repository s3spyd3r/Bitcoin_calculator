<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="<?php echo $config['site_desc']; ?>">
      <title><?php echo $config['site_title']; ?> - <?php echo $page_title; ?></title>
      <!-- Google fonts CSS -->
      <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700" rel="stylesheet" type="text/css">
      <!-- Bootstrap core CSS -->
      <link href="<?php echo $config['base_url']; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
      <!-- Ember Components CSS -->
      <link href="<?php echo $config['base_url']; ?>/assets/css/site.css" rel="stylesheet">
</head>
<body>
      <nav class="navbar navbar-inverse navbar-static-top navbar-color" style="background-color: <?php echo $config['site_color']; ?>;">
            <div class="container">
                  <div class="navbar-header">
                        <a href="<?php echo $config['base_url']; ?>">
                            <img src="<?php echo isset($config['site_logo']) ? $config['site_logo'] : $config['base_url'] . '/assets/img/logo.png'; ?>" alt="logo" class="crypto-logo">
                        </a>
                  </div>
            </div>
      </nav>