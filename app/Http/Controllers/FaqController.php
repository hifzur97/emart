<?php
namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;


class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('faq.view'),403,'User does not have the right permissions.');
        $faqs = Faq::all();
        return view("admin.faq.index", compact("faqs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(!auth()->user()->can('faq.create'),403,'User does not have the right permissions.');
        $faq = Faq::all();
        return view("admin.faq.add", compact("faq"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('faq.create'),403,'User does not have the right permissions.');

        $data = $this->validate($request, ["ans" => "required", "que" => "required",

        ], [

        "ans.required" => "Answer Fild is Required", "que.required" => "Question Fild is Required",

        ]);

        $input = $request->all();
        $faq = Faq::create($input);
        $faq->save();

        return back()
            ->with('added', 'Faq has been Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Category $category)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        abort_if(!auth()->user()->can('faq.edit'),403,'User does not have the right permissions.');

        $faq = Faq::findOrFail($id);

        return view("admin.faq.edit", compact("faq"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(!auth()->user()->can('faq.edit'),403,'User does not have the right permissions.');

        $data = $this->validate($request, ["ans" => "required", "que" => "required",

        ], [

        "ans.required" => "Answer Fild is Required", "que.required" => "Question Fild is Required",

        ]);

        $faq = Faq::findOrFail($id);
        $input = $request->all();
        $faq->update($input);

        return redirect('admin/faq')->with('updated', 'Faq has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!auth()->user()->can('faq.delete'),403,'User does not have the right permissions.');

        $cat = Faq::find($id);
        $value = $cat->delete();
        if ($value)
        {
            session()->flash("deleted", "Faq Has Been Deleted");
            return redirect("admin/faq");
        }
    }

}

