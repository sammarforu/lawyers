<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_student = new Role();
		$role_student->name = 'Student';
		$role_student->description = 'A Normal Student';
		$role_student->save();
		
		$role_teacher = new Role();
		$role_teacher->name = 'Teacher';
		$role_teacher->description = 'A Teacher';
		$role_teacher->save();
		
		$role_admin = new Role();
		$role_admin->name = 'Admin';
		$role_admin->description = 'An Admin';
		$role_admin->save();
		
    }
}
