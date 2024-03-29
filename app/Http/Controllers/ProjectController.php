<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    public function getProjectList(Request $req)
    {
        $pageIndex = (int) $req->pageIndex;
        $pageSize = (int) $req->pageSize;
        $search = $req->search;
        $projects = Project::getAllProjects($pageIndex, $pageSize, $search);
        $total = Project::countProject();
        return response()->json(array('projects' => $projects, 'total' => $total), 200);
    }

    public function getProjectById(Request $req)
    {
        $id = (int) $req->id;
        $project = Project::getProjectById($id);
        return response()->json(array('project' => $project), 200);
    }

    public function updateProjectById(Request $req)
    {
        $project = $req->all();
        $project['id'] = (int) $project['id'];
        $project['excutionTime'] = floatval($project['excutionTime']);
        $project['cost'] = floatval($project['cost']);
        $project['incom'] = floatval($project['incom']);
        $project['guarantee'] = floatval($project['guarantee']);
        $result = Project::updateProjectById($project['id'], $project['projectName'], $project['projectDescription'], $project['teamSize'], $project['gitUrl'], $project['excutionTime'], $project['cost'], $project['incom'], $project['guarantee']);
        if ($result == 1) {
            $updatedProject = Project::getProjectById($project['id']);
            return response()->json(array('message' => 'Updated project successfully', 'project' => $updatedProject), 200);
        } else {
            return response()->json(array('message' => 'Cannot update project'), 200);
        }
    }

    public function deleteProjectById(Request $req)
    {
        $project = $req->all();
        $id = $project['id'];
        $deletedProjectRes = Project::deleteProjectById($id);
        if ($deletedProjectRes == 1) {
            $deletedProject = Project::getDeletedProjectById($id);
            return response()->json(array('message' => 'Deleted project successfully', 'project' => $deletedProject), 200);
        } else {
            return response()->json(array('message' => 'Cannot delete project'), 200);
        }
    }

    public function createProject(Request $req)
    {
        $project = $req->all();
        $project['excutionTime'] = floatval($project['excutionTime']);
        $project['cost'] = floatval($project['cost']);
        $project['incom'] = floatval($project['incom']);
        $project['guarantee'] = floatval($project['guarantee']);
        $createdId = Project::createProject($project['projectName'], $project['projectDescription'], $project['teamSize'], $project['gitUrl'], $project['excutionTime'], $project['cost'], $project['incom'], $project['guarantee']);
        $result = Project::getProjectById($createdId);
        return response()->json(array('message' => 'Created project successfully', 'project' => $result), 200);
    }
}
