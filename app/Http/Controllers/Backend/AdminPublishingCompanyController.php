<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PublishingCompany;
use App\Http\Requests\PublishingCompanyRequest;

class AdminPublishingCompanyController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'Publishing_Company',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $publishingCompany = PublishingCompany::orderBy('id', 'DESC')->paginate(10);
        $viewData = [
            'publishingCompany' => $publishingCompany
        ];
        return view('backend.publishing_company.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.publishing_company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublishingCompanyRequest $request)
    {
        //
        if ($this->createOrUpdate($request)) {
            return redirect()->back()->with('success', 'Thêm mới thành công dữ liệu.');
        }
        return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $publishingCompany = PublishingCompany::find($id);
        if (!$publishingCompany) {
            return redirect()->route('get.list.publishing_company')->with('danger', 'Dữ liệu không tồn tại.');
        }

        return view('backend.publishing_company.update', compact('publishingCompany'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($this->createOrUpdate($request, $id)) {
            return redirect()->back()->with('success', 'Cập nhật thành công dữ liệu.');
        }
        return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $publishingCompany = PublishingCompany::findOrFail($id);
        if (!$publishingCompany) {
            return redirect()->route('get.list.publishing_company')->with('danger', 'Dữ liệu không tồn tại..');
        }
        try {
            $publishingCompany->delete();

            return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
        }
    }

    /**
     * @param $request
     * @param string $id
     */
    public function createOrUpdate($request, $id = '')
    {
        $publishingCompany = new PublishingCompany();
        if ($id) {
            $publishingCompany = PublishingCompany::findOrFail($id);
        }
        $publishingCompany->pc_name = $request->pc_name;
        $publishingCompany->pc_email = $request->pc_email;
        $publishingCompany->pc_phone = $request->pc_phone;
        $publishingCompany->pc_address = $request->pc_address;
        $publishingCompany->pc_status = $request->pc_status;
        if (!$publishingCompany->save()) {
            return false;
        }
        return true;
    }
}
