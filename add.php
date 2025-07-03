<?php
/**
 * Страница создания олимпиады
 * Путь: blocks/olympics/add.php
 */
require(__DIR__ . '/../../config.php');
require_login();

$PAGE->set_url(new moodle_url('/blocks/olympics/add.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Создать олимпиаду');
$PAGE->set_heading('Создать олимпиаду');

$form = new \block_olympiads\form\olympiads_form();


/* ---------- обработка отправки ---------- */
if ($form->is_cancelled()) {
    redirect(new moodle_url('/my'));                    // «Отмена»

} elseif ($data = $form->get_data()) {
    // Подготовим объект для вставки
    $record              = new stdClass();
    $record->name        = $data->name;
    $record->description = $data->description;
    $record->startdate   = $data->startdate;            // уже Unix-time
    $record->enddate     = $data->enddate;

    $id = $DB->insert_record('block_olympiads', $record); // ✅


    redirect(
        new moodle_url('/blocks/olympics/add.php'),
        'Олимпиада сохранена (ID '.$id.')',
        null,
        \core\output\notification::NOTIFY_SUCCESS
    );
    // выполнение остановится здесь
}

/* ---------- вывод формы ---------- */
echo $OUTPUT->header();
echo $OUTPUT->heading('Создание олимпиады');
$form->display();
echo $OUTPUT->footer();
