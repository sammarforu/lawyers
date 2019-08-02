<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
		//$role_student = Role::where('name', 'Student')->first();
		//$role_teacher = Role::where('name', 'Teacher')->first();
		//$role_admin = Role::where('name', 'Admin')->first();
		$user = new User();
		$user->name = 'User';
		$user->email = 'user@gmail.com';
		$user->password = bcrypt('user00');
		$user->image = 'user.jpg';
		$user->save();
		//$student->roles->attach()->($role_student);
		
		$author = new User();
		$author->name = 'Author';
		$author->email = 'author@gmail.com';
		$author->password = bcrypt('author00');
		$author->image = 'author.jpg';
		$author->save();
		// $teacher->roles->attach()->($role_teacher);
		
		$admin = new User();
		$admin->name = 'Admin';
		$admin->email = 'sammarforu@gmail.com';
		$admin->password = bcrypt('sammar');
		$admin->image = 'admin.jpg';
		$admin->save();
		//$admin->roles->attach()->($role_admin);
		
		
    }
}
