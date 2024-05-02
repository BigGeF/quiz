<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');

$f3 = Base::instance();
$f3->set('SESSION.auto_start', true);

$f3->route('GET /', function ($f3) {
    $view = new Template();
    echo $view->render('views/home.html');
});


$f3->route('GET|POST /survey', function($f3) {
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $name = $f3->get('POST.name');
        $easy = $f3->get('POST.checkbox1') ? 'This midterm is easy' : '';
        $like = $f3->get('POST.checkbox2') ? 'I like midterm' : '';
        $monday = $f3->get('POST.checkbox3') ? 'Today is Monday' : '';

        $f3->set('SESSION.name', $name);
        $f3->set('SESSION.easy', $easy);
        $f3->set('SESSION.like', $like);
        $f3->set('SESSION.monday', $monday);

        $f3->reroute('result');
    } else {
        $view = new Template();
        echo $view->render('views/survey.html'); // Assuming you have a separate view file for the form
    }
});



$f3->route('GET /result', function ($f3) {
    $view = new Template();
    echo $view->render('views/results.html');
});

$f3->run();

