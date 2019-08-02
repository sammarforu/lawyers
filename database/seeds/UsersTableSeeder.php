<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
		$role_student = Role::where('name', 'Student')->first();
		$role_teacher = Role::where('name', 'Teacher')->first();
		$role_admin = Role::where('name', 'Admin')->first();
		
        $student = new User();
		$student->name = 'Editor';
		$student->email = 'editor@gmail.com';
		$student->password = bcrypt('editor');
		$student->image = 'editor.jpg';
		$student->save();
		$student->roles()->attach($role_student);
		
		$admin = new User();
		$admin->name = 'Admin';
		$admin->email = 'sammarforu@gmail.com';
		$admin->password = bcrypt('sammar');
		$admin->image = 'sammar.jpg';
		$admin->save();
		$admin->roles()->attach($role_admin);
		
		$teacher = new User();
		$teacher->name = 'author';
		$teacher->email = 'author@gmail.com';
		$teacher->password = bcrypt('author');
		$teacher->image = 'author.jpg';
		$teacher->save();
		$teacher->roles()->attach($role_teacher);
		
    }
}
