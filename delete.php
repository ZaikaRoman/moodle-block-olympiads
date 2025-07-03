<?php
require_once(__DIR__ . '/../../config.php');
require_login();

$id = required_param('id', PARAM_INT); // получаем id олимпиады

$PAGE->set_url(new moodle_url('/blocks/olympiads/delete.php', ['id' => $id]));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Удаление олимпиады');
$PAGE->set_heading('Удаление олимпиады');

global $DB, $OUTPUT;

// Проверим, существует ли запись
if (!$record = $DB->get_record('block_olympiads', ['id' => $id])) {
    throw new moodle_exception('Олимпиада не найдена');
}

// Удалим запись
$DB->delete_records('block_olympiads', ['id' => $id]);

// Перенаправим на список
redirect(new moodle_url('/blocks/olympiads/list.php'), 'Олимпиада удалена', 2);
