<?php
require_once(__DIR__ . '/../../config.php');
require_login();

global $DB, $OUTPUT, $PAGE;

// Настройка страницы
$PAGE->set_url(new moodle_url('/blocks/olympiads/register.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Запись на олимпиаду');
$PAGE->set_heading('Запись на олимпиаду');

// Таблица регистрации
$table = 'block_olympiads_registration';

// Обработка POST
if (optional_param('id', 0, PARAM_INT) && confirm_sesskey()) {
    $record = new stdClass();
    $record->olympiadid = required_param('id', PARAM_INT);
    $record->userid     = $USER->id;
    $DB->insert_record($table, $record);
    redirect(new moodle_url('/blocks/olympiads/register.php'));
}

// Получаем все олимпиады
$olymps = $DB->get_records('block_olympiads');

// Генерируем скрытое поле sesskey один раз
$sesskeyfield = html_writer::empty_tag('input', [
    'type'  => 'hidden',
    'name'  => 'sesskey',
    'value' => sesskey()
]);

// Собираем данные для шаблона
$data = ['olympiads' => []];
foreach ($olymps as $o) {
    $registered = $DB->record_exists($table, [
        'olympiadid' => $o->id,
        'userid'     => $USER->id
    ]);
    $data['olympiads'][] = [
        'id'          => $o->id,
        'name'        => format_string($o->name),
        'startdate'   => userdate($o->startdate, '%d.%m.%Y'),
        'enddate'     => userdate($o->enddate,   '%d.%m.%Y'),
        'registered'  => $registered,
        'registerurl' => (string)new moodle_url('/blocks/olympiads/register.php'),
        'sesskey'     => $sesskeyfield
    ];
}

// Вывод
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('block_olympiads/register', $data);
echo $OUTPUT->footer();
