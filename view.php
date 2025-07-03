<?php
require_once(__DIR__ . '/../../config.php');
require_login();

global $DB, $PAGE, $OUTPUT;

// --- Настройка страницы ---
$PAGE->set_url(new moodle_url('/blocks/olympiads/view.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Олимпиады для абитуриентов');
$PAGE->set_heading('Олимпиады для абитуриентов');

// --- Получаем данные из БД ---
$records = $DB->get_records('block_olympiads');

// --- Готовим URL картинки из pix/olympiad.png ---
$iconurl = $OUTPUT
    ->image_url('olympiad', 'block_olympiads')
    ->out(false);

// --- Формируем массив для шаблона ---
$data = ['olympiads' => []];
foreach ($records as $r) {
    $data['olympiads'][] = [
        'name'      => format_string($r->name),
        'startdate' => userdate($r->startdate, '%d.%m.%Y'),
        'enddate'   => userdate($r->enddate,   '%d.%m.%Y'),
        'imageurl'  => $iconurl
    ];
}

// --- Вывод страницы через шаблон ---
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('block_olympiads/cards', $data);
echo $OUTPUT->footer();
