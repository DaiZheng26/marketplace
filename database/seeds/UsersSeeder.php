<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrator
        //  - All permissions : add,edit,delete
        //  - All site settings
        //  - All webmaster settings

        $newuser = new User();
        $newuser->name = "admin";
        $newuser->email = "admin@site.com";
        $newuser->password = bcrypt("admin");
        $newuser->permissions_id = "1";
        $newuser->status = "1";
        $newuser->created_by = 1;
        $newuser->save();

        // Site Manager
        //  - All permissions : add,edit,delete
        //  - All site settings

        $newuser = new User();
        $newuser->name = "manager";
        $newuser->email = "manager@site.com";
        $newuser->password = bcrypt("manager");
        $newuser->permissions_id = "2";
        $newuser->status = "1";
        $newuser->created_by = 1;
        $newuser->save();

        // Normal User
        //  - Permissions : add,edit
        //  - No site settings & no delete

        $newuser = new User();
        $newuser->name = "user";
        $newuser->email = "user@site.com";
        $newuser->password = bcrypt("user");
        $newuser->permissions_id = "3";
        $newuser->status = "1";
        $newuser->created_by = 1;
        $newuser->save();

    }
}
