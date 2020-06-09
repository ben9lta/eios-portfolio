<?php


namespace common\models\db;


use Yii;
use yii\db\QueryBuilder;

class Tables
{
    public CONST TABLE_NAMES = [
        'achievements'  => 'Достижения',
        'activity_type' => 'Тип деятельности',
        'courseworks'   => 'Курсовые работы',
        'department'    => 'Подразделение',
        'direction'     => 'Направление',
        'doc_maintypes' => 'Главные типы документов',
        'doc_types'     => 'Типы документов',
        'documents'     => 'Документы',
        'edu_form'      => 'Форма образования',
        'edu_level'     => 'Уровень образования',
        'event_status'  => 'Статус мероприятия',
        'event_type'    => 'Тип мероприятия',
        'events'        => 'Мероприятия',
        'group'         => 'Группы',
        'institute'     => 'Институты',
        'practics'      => 'Практики',
        'publ_indexing' => 'Индексация публикаций',
        'publications'  => 'Публикации',
        'shedule'       => 'Расписание',
        'students'      => 'Студенты',
        'univer'        => 'Универ',
        'user'          => 'Пользователи',
        'vkr'           => 'ВКР',
    ];

    public CONST LINKS = [
        'achievements'  => 'achievements',
        'activity_type' => 'activity-type',
        'courseworks'   => 'courseworks',
        'department'    => 'department',
        'direction'     => 'direction',
        'doc_maintypes' => 'doc-maintypes',
        'doc_types'     => 'doc-types',
        'documents'     => 'documents',
        'edu_form'      => 'edu-form',
        'edu_level'     => 'edu-level',
        'event_status'  => 'event-status',
        'event_type'    => 'event-type',
        'events'        => 'events',
        'group'         => 'group',
        'institute'     => 'institute',
        'practics'      => 'practics',
        'publ_indexing' => 'publ-indexing',
        'publications'  => 'publications',
        'shedule'       => 'shedule',
        'students'      => 'students',
        'univer'        => 'univer',
        'user'          => 'users',
        'vkr'           => 'vkr',
    ];

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public function getAllTables()
    {
        $connection = Yii::$app->getDb();
        $tables = $connection->createCommand(/** @lang mysql */ "
            SELECT 'univer' as 'table', COUNT(*) as 'count' FROM univer UNION
            (SELECT 'institute', COUNT(*) FROM institute) UNION
            (SELECT 'department', COUNT(*) FROM department) UNION
            (SELECT 'direction', COUNT(*) FROM direction) UNION
            (SELECT 'edu_level', COUNT(*) FROM edu_level) UNION
            (SELECT 'edu_form', COUNT(*) FROM edu_form) UNION
            (SELECT 'group', COUNT(*) FROM `group`) UNION
            (SELECT 'students', COUNT(*) FROM students) UNION
            (SELECT 'user', COUNT(*) FROM user) UNION
            (SELECT 'vkr', COUNT(*) FROM vkr) UNION
            (SELECT 'publications', COUNT(*) FROM publications) UNION
            (SELECT 'publ_indexing', COUNT(*) FROM publ_indexing) UNION
            (SELECT 'events', COUNT(*) FROM events) UNION
            (SELECT 'event_type', COUNT(*) FROM event_type) UNION
            (SELECT 'event_status', COUNT(*) FROM event_status) UNION
            (SELECT 'achievements', COUNT(*) FROM achievements) UNION
            (SELECT 'activity_type', COUNT(*) FROM activity_type) UNION
            (SELECT 'courseworks', COUNT(*) FROM courseworks) UNION
            (SELECT 'practics', COUNT(*) FROM practics) UNION
            (SELECT 'documents', COUNT(*) FROM documents) UNION
            (SELECT 'doc_maintypes', COUNT(*) FROM doc_maintypes) UNION
            (SELECT 'doc_types', COUNT(*) FROM doc_types) UNION
            (SELECT 'shedule', COUNT(*) FROM shedule);");

        return $tables->queryAll();
    }
}
