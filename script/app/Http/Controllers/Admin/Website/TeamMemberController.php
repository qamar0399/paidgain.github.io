<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Categorymeta;
use DB;
use Illuminate\Http\Request;
use Throwable;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = Category::where([
            'type' => 'team_members'
        ])->with('meta')->paginate();

        return view('admin.website.team-members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.website.team-members.create');
    }

    public function store(Request $request)
    {
        $this->teamMemberCrud($request, new Category());

        return response()->json(__('Team Member Created Successfully'));
    }

    public function edit(Category $team_member)
    {
        return view('admin.website.team-members.edit', compact('team_member'));
    }

    public function update(Request $request, Category $team_member)
    {
        $this->teamMemberCrud($request, $team_member);

        return response()->json(__('Team Member Updated Successfully'));
    }

    public function destroy(Category $team_member)
    {
        $team_member->delete();

        return redirect()->back()->with(__('Team Member Deleted Successfully'));
    }

    private function teamMemberCrud(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'position' => ['required', 'string'],
            'image' => ['required', 'string'],
            'featured' => ['nullable', 'string']
        ]);

        DB::beginTransaction();
        try {
            $category->type = 'team_members';
            $category->name = $request->name;
            $category->other = $request->position;
            $category->featured = $request->has('featured');
            $category->save();

            Categorymeta::set($category->id, 'info', json_encode([
                'image' => $request->image
            ]));

            DB::commit();

            cache()->forget('website.home_' . current_locale());
            cache()->forget('website.about_' . current_locale());
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
