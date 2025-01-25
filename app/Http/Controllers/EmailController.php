<?php

namespace App\Http\Controllers;

use App\Imports\EmailListImport;
use App\Models\EmailList;
use App\Models\Group;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmailController extends Controller
{
    public function allGroup()
    {
        $groups = Group::with('totoalMail')->get();
        return view('group.all', [
            'groups' => $groups
        ]);
    }

    public function addGroup()
    {
        return view('group.add');
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:xlsx'
        ]);


        // $import = new EmailListImport();
        $data = Excel::toCollection(null, $request->file('file'));
        if (count($data) > 1) {
            $modifyDatas = $data[0]->map(function ($row) {
                return $row[0];
            });
        } else {
            $modifyDatas = $data->map(function ($row) {
                return $row[0];
            });
        }


        $group = new Group();
        $group->name = $request->name;
        $group->save();

        $id = $group->id;


        foreach ($modifyDatas as $modifyData) {
            if ($modifyData) {
                $emailCheck = EmailList::where('email', $modifyData)->first();
                if (!$emailCheck) {
                    $newEmail = new EmailList();
                    $newEmail->email = $modifyData;
                    $newEmail->group_id = $id;
                    $newEmail->save();
                }
            }

        }

        return redirect()->route('group.all')->with('success', 'Group Created Successfully');
    }

    public function editGroup($id)
    {
        $group = Group::with('totoalMail')->findOrFail($id);
        return view('group.edit', [
            'group' => $group
        ]);
    }


    public function updateGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id' => 'required'
        ]);

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:xlsx'
            ]);
        }

        $group = Group::findOrFail($request->id);
        $group->name = $request->name;
        $group->update();


        if ($request->hasFile('file')) {

            $data = Excel::toCollection(null, $request->file('file'));
            if (count($data) > 1) {
                $modifyDatas = $data[0]->map(function ($row) {
                    return $row[0];
                });
            } else {
                $modifyDatas = $data->map(function ($row) {
                    return $row[0];
                });
            }
            EmailList::where('group_id', $group->id)->delete();
            foreach ($modifyDatas as $modifyData) {
                if ($modifyData) {

                    $newEmail = new EmailList();
                    $newEmail->email = $modifyData;
                    $newEmail->group_id = $group->id;
                    $newEmail->save();
                }

            }

        }


        return back()->with('success', 'Update Successfully');
    }

    public function deleteGroup($id)
    {
        $group = Group::findOrFail($id);
        EmailList::where('group_id', $group->id)->delete();
        $group->delete();
        return back()->with('success', 'Deleted Successfully');
    }

    public function groupMailDelete($id)
    {
        $email = EmailList::findOrFail($id);

        $email->delete();
    }
}
