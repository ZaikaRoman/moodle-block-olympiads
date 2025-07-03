<?php
require('../../config.php');
require_login();

require_once($CFG->dirroot . '/blocks/olympiads/classes/form/olympiad_form.php');

$PAGE->set_url(new moodle_url('/blocks/olympiads/add.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Добавить олимпиаду');
$PAGE->set_heading('Добавить олимпиаду');

$form = new \block_olympiads\form\olympiad_form();

if ($form->is_cancelled()) {
    redirect(new moodle_url('/my')); // при отмене возвращаемся на главную
} else if ($data = $form->get_data()) {
    // Пока просто отладочный вывод
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

echo $OUTPUT->header();
echo $OUTPUT->heading('Добавление олимпиады');

$form->display();

echo $OUTPUT->footer();
