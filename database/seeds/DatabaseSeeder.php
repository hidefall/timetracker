<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         factory(\App\Models\User::class, 50)->create()->each(function($user){
             factory(\App\Models\Profile::class)->create(['user_id'=>$user->id]);
             factory(\App\Models\Client::class, 5)->create(['user_id'=>$user->id]);
             if($user->id % 2 == 0) {
                 factory(\App\Models\Company::class)->create()->each(function($company) use ($user){
                     $user->company_id = $company->id;
                     $user->save();
                 });
                 factory(\App\Models\Project::class, 10)->create(['user_id'=>$user->id])->each(function($project) use ($user){
                     factory(\App\Models\Client::class, 10)->create(['user_id'=>$user->id])->each(function($client) use ($user, $project){
                         $project->client_id = $client->id;
                         $project->save();
                     });
                     factory(\App\Models\Task::class, 10)->create(['user_id'=>$user->id,'project_id'=>$project->id])->each(function($task) use ($user){
                         factory(\App\Models\TimeFrame::class, 10)->create(['user_id'=>$user->id,'task_id'=>$task->id]);
                     });
                 });
             }
             factory(\App\Models\Project::class, 10)->create(['user_id'=>$user->id]);
             factory(\App\Models\Task::class, 10)->create(['user_id'=>$user->id]);
             factory(\App\Models\TimeFrame::class, 10)->create(['user_id'=>$user->id]);
         });

         factory(\App\Models\Tag::class, 150)->create();

        $path = base_path().'/database/sql/countries.sql';
        $sql = file_get_contents($path);
        \Illuminate\Support\Facades\DB::unprepared($sql);

        $path = base_path().'/database/sql/states.sql';
        $sql = file_get_contents($path);
        \Illuminate\Support\Facades\DB::unprepared($sql);

        $path = base_path().'/database/sql/cities.sql';
        $sql = file_get_contents($path);
        \Illuminate\Support\Facades\DB::unprepared($sql);
    }
}
