<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('SubjectTableSeeder');

        $this->command->info('Subject table seeded!');
    }

}

class SubjectTableSeeder extends Seeder {

    public function run()
    {
        DB::table('Subjects')->delete();
        DB::table('Categories')->delete();

        Subject::create(array('name' => 'Laravel'));

    }

}