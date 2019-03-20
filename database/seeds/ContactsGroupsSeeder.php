<?php

use Illuminate\Database\Seeder;

use App\ContactsGroup;

class ContactsGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // News Letter Group
        $ContactsGroup = new ContactsGroup();
        $ContactsGroup->name = "Newsletter Emails";
        $ContactsGroup->created_by = 1;
        $ContactsGroup->save();
    }
}
