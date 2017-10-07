<?php

$code = htmlentities($_GET['code']);

$page_title = $code;

require_once('includes/site.load.php');

$bvalues = $bitcoin->jsonCache($config['cache_time']);

// Get amount for calculator, set default as 1
if (!isset($_GET['amt']))
    $amount = '1';
else
    $amount = $_GET['amt'];

// Calculate
foreach ($bvalues as $k => $v)
    if ($k == $code)
        $value = $v * $amount;

// Redirect if it is a bad page
if ($value < '1') 
{
    header("Location: " . $config['base_url']);
    die();
}

?>
        <div class="hero" style="background-color: <?php echo $config['site_color']; ?>;">
            <div class="container">
                <h2><?php echo $amount; ?> Bitcoin = <?php echo round($value, 2) . '&nbsp' . $code; ?></h2>
                <p>You are currently using the calculator for <?php echo $bitcoin->code2name($code); ?></p>
                <div class="buttons">
                    <form class="form-inline" method="GET" action="<?php echo $config['base_url']; ?>/calculator.php">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-lg" id="ember-form" placeholder="Amount of btc" name="amt" value="1">
                            </div>
                            <div class="input-group">
                                <select class="form-control input-lg" id="ember-form" name="code">
<?php
// Options for the select box 
foreach($bvalues as $k => $v)
    if($k == $code)
        echo '<option value="' . $k . '" selected>' . $k . '</option>';
    else
        echo '<option value="' . $k . '">' . $k . '</option>';
?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-outline btn-round">Convert</button>
                    </form>
                </div>
            </div>
        </div>
        <section id="currencies">
            <div class="container">
                <div class="feature-head mobile-hide">
                    <h2>28 Currencies Supported</h2>
                    <p>Calculate and quickly view the BTC value in 28 currencies</p>
                </div>
                <div class="row">
<?php 
// List all of the currencies
foreach($bvalues as $k => $v) 
{
if ($bitcoin->code2name($k))
    echo '<div class="col-md-4">
    <div class="ember-currency">
        <div class="icon-feature">
            <div class="icon">
                <div class="circle">' . $k . '</div>
            </div>
            <h3><a href="' . $config['base_url'] . '/currency/' . $k . '">' . $bitcoin->code2name($k) . '</a></h3>
            <p>1 BTC = ' . round($v, 2) . '&nbsp;' . $k . '</p>
        </div>
    </div>
</div>';
} 
?>
                </div>
            </div>
        </section>
<?php

require_once('includes/wrapper/footer.template.php');

?>
