<?php
require_once(__DIR__ . '/../../config.php');
require_login();

global $DB, $OUTPUT, $PAGE;

$PAGE->set_url(new moodle_url('/blocks/olympiads/list.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Список олимпиад');
$PAGE->set_heading('Список олимпиад');

$records = $DB->get_records('block_olympiads');

$table = new html_table();
$table->head = ['Название', 'Описание', 'Дата начала', 'Дата окончания', 'Действия'];

foreach ($records as $record) {
    $editurl = new moodle_url('/blocks/olympiads/add.php', ['id' => $record->id]);
    $deleteurl = new moodle_url('/blocks/olympiads/delete.php', ['id' => $record->id]);

    $editicon = $OUTPUT->action_icon($editurl, new pix_icon('t/edit', 'Редактировать'));
    $deleteicon = $OUTPUT->action_icon($deleteurl, new pix_icon('t/delete', 'Удалить'));

    $table->data[] = [
        format_string($record->name),
        format_text($record->description),
        userdate($record->startdate),
        userdate($record->enddate),
        $editicon . ' ' . $deleteicon
    ];
}

echo $OUTPUT->header();
echo html_writer::link(new moodle_url('/blocks/olympiads/add.php'), 'Добавить олимпиаду', ['class' => 'btn btn-primary']);
echo html_writer::table($table);
echo $OUTPUT->footer();
