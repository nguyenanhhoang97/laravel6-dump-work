<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Project extends Model
{
    protected $table = 'projects';

    public $timestamps = true;

    public static function getAllProjects($pageIndex, $pageSize, $search)
    {

        $offset = $pageIndex * $pageSize;
        return DB::table('projects')
            ->where('is_deleted', false)
            // ->where('project_name', 'like', '%' . $search . '%')
            // ->offset($offset)
            // ->limit($pageSize)
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getProjectById($id)
    {
        return DB::table('projects')
            ->where('id', $id)
            ->where('is_deleted', false)
            ->first();
    }

    public static function getDeletedProjectById($id)
    {
        return DB::table('projects')
            ->where('id', $id)
            ->where('is_deleted', true)
            ->first();
    }

    public static function updateProjectById(
        $id,
        $project_name,
        $project_description,
        $team_size,
        $git_url,
        $execution_time,
        $cost,
        $incom,
        $guarantee
    ) {
        return DB::table('projects')
            ->where('id', $id)
            ->where('is_deleted', false)
            ->update([
                'project_name' => $project_name,
                'project_description' => $project_description,
                'team_size' => $team_size,
                'git_url' => $git_url,
                'execution_time' => $execution_time,
                'cost' => $cost,
                'incom' => $incom,
                'guarantee' => $guarantee
            ]);
    }

    public static function deleteProjectById($id)
    {

        return DB::table('projects')
            ->where('id', $id)
            ->where('is_deleted', false)
            ->update([
                'is_deleted' => true
            ]);
    }


    public static function createProject(
        $project_name,
        $project_description,
        $team_size,
        $git_url,
        $execution_time,
        $cost,
        $incom,
        $guarantee
    ) {
        return DB::table('projects')
            ->insertGetId([
                'project_name' => $project_name, 'project_description' => $project_description, 'team_size' => $team_size, 'git_url' => $git_url, 'execution_time' => $execution_time, 'cost' => $cost, 'incom' => $incom, 'guarantee' => $guarantee
            ]);
    }

    public static function restoreProject($id)
    {
        return DB::table('projects')
            ->where('id', $id)
            ->where('is_deleted', true)
            ->update([
                'is_deleted' => false
            ]);
    }

    public static function countProject()
    {
        return DB::table('projects')
            ->count();
    }
}
