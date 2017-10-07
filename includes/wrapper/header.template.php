<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="<?php echo $config['site_desc']; ?>">
      <link rel="icon" href="<?php echo $config['base_url']; ?>/assets/img/favicon.ico">
      <title><?php echo $config['site_title']; ?> - <?php echo $page_title; ?></title>
      <!-- Google fonts CSS -->
      <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700" rel="stylesheet" type="text/css">
      <!-- Bootstrap core CSS -->
      <link href="<?php echo $config['base_url']; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
      <!-- Ember Components CSS -->
      <link href="<?php echo $config['base_url']; ?>/assets/css/ember.css" rel="stylesheet">
</head>
<body>
      <nav class="navbar navbar-inverse navbar-static-top navbar-color" style="background-color: <?php echo $config['site_color']; ?>;">
            <div class="container">
                  <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo $config['base_url']; ?>"><img src="<?php echo $config['base_url']; ?>/assets/img/logo.png" alt="logo"></a>
                  </div>
                  <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                              <li style="padding: 10px;"><a href="https://twitter.com/share" class="twitter-share-button" data-size="large">Tweet</a>
                              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
                        </ul>
                  </div>
            </div>
      </nav>