<?php

return [
    'enable' => function ($app) {
        $util = $app['db']->getUtility();
        if ($util->tableExists('@svksf_wahlen_candidatures') === false) {
            $util->createTable('@svksf_wahlen_candidatures', function ($table) {
                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('name', 'string', ['length' => 255]);
                $table->addColumn('email', 'string', ['length' => 255]);
                $table->addColumn('class', 'string', ['length' => 5]);
                $table->addColumn('is_class_rep', 'boolean');
                $table->addColumn('office', 'string', ['length' => 255]);
                $table->addColumn('deputy', 'boolean');
                $table->addColumn('status', 'smallint');
                $table->addColumn('message', 'text');
                $table->addColumn('date', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
                $table->addColumn('rejection_reason', 'text');
                $table->addColumn('rejection_date', 'datetime', ['notnull' => false]);
                $table->setPrimaryKey(['id']);
            });
        }
    },

    'disable' => function ($app) {
        $util = $app['db']->getUtility();

        if ($util->tableExists('@svksf_wahlen_candidatures')) {
            $util->dropTable('@svksf_wahlen_candidatures');
        }
    }
];
