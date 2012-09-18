<?php
require_once 'php/SafePHP.php';

//$language = $_POST['language'];
$code     = $_POST['code'];
$explodedCode = explode('\n', $code);
if (strpos($explodedCode[0], '<?php') !== false || strpos($explodedCode[0], '<?') !== false) {
    $explodedCode[0] = str_replace(array("<?php", "<?"), '', $explodedCode[0]);
    $code = implode($explodedCode);
}

$safe = new SafePHP();
$output = $safe->evaluate($code);
$return = array(
    'status' => 'success',
    'output' => $output['output'],
    'debug'  => $output['debug']
);
if(isset($output['error']))
    $return['earray'] = $output['error'];

echo(json_encode($return));
