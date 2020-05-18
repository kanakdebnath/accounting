<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Carbon\Carbon;

class SettingController extends Controller
{

	public function index(Request $request)
	{
		if (!auth()->user()->can('configuration.view')) {
			abort(403, 'Unauthorized action.');
		}

		if ($request->isMethod('get')) {
			return view('admin.setting.general');
		} else {
			foreach ($_POST as $key => $value) {
				if ($key == "_token") {
					continue;
				}

				$data = array();
				$data['value'] = $value;
				$data['updated_at'] = Carbon::now();
				if (Setting::where('name', $key)->exists()) {
					Setting::where('name', '=', $key)->update($data);
				} else {
					$data['name'] = $key;
					$data['created_at'] = Carbon::now();
					Setting::insert($data);
				}
			}

			return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('System Configuration Updated')]);
		}
	}

	public function upload_logo(Request $request)
	{
		if (!auth()->user()->can('configuration.create')) {
			abort(403, 'Unauthorized action.');
		}
		$validator = Validator::make($request->all(), [
			'logo' => 'mimes:jpeg,bmp,png,jpg|max:2000',
			'favicon' => 'mimes:jpeg,bmp,png,jpg|max:2000',
		]);

		if ($validator->fails()) {
			return response()->json(['success' => false, 'status' => 'danger', 'message' => $validator->errors()]);
		}

		if ($request->hasFile('logo')) {
			$storagepath = $request->file('logo')->store('public/logo');
			$fileName = basename($storagepath);
			$logo['name'] = 'logo';
			$logo['value'] = $fileName;

			//if file chnage then delete old one
			$oldFile = $request->get('oldLogo', '');
			if ($oldFile != '') {
				$file_path = "public/logo/" . $oldFile;
				Storage::delete($file_path);
			}
		} else {
			$logo['name'] = 'logo';
			$logo['value'] = $request->get('oldLogo', '');
		}

		if ($request->hasFile('favicon')) {
			$storagepath = $request->file('favicon')->store('public/logo');
			$fileName = basename($storagepath);
			$data['name'] = 'favicon';
			$data['value'] = $fileName;

			//if file chnage then delete old one
			$oldFile = $request->get('oldfavicon', '');
			if ($oldFile != '') {
				$file_path = "public/logo/" . $oldFile;
				Storage::delete($file_path);
			}
		} else {
			$data['name'] = 'favicon';
			$data['value'] = $request->get('oldfavicon', '');
		}

		if (Setting::where('name', "logo")->exists()) {
			Setting::where('name', '=', "logo")->update($logo);
		} else {

			$logo['created_at'] = Carbon::now();
			Setting::insert($logo);
		}

		if (Setting::where('name', "favicon")->exists()) {
			Setting::where('name', '=', "favicon")->update($data);
		} else {
			$data['created_at'] = Carbon::now();
			Setting::insert($data);
		}
		return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Logo And Favicon  Updated.')]);
	}

	public function api()
	{
		if (!auth()->user()->can('configuration.create')) {
			abort(403, 'Unauthorized action.');
		}
		foreach ($_POST as $key => $value) {
			if ($key == "_token") {
				continue;
			}

			$data = array();
			$data['value'] = $value;
			$data['updated_at'] = Carbon::now();
			if (Setting::where('name', $key)->exists()) {
				Setting::where('name', '=', $key)->update($data);
			} else {
				$data['name'] = $key;
				$data['created_at'] = Carbon::now();
				Setting::insert($data);
			}
		}

		return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Api Link Updated.')]);
	}


	public function social()
	{
		if (!auth()->user()->can('configuration.create')) {
			abort(403, 'Unauthorized action.');
		}
		foreach ($_POST as $key => $value) {
			if ($key == "_token") {
				continue;
			}

			$data = array();
			$data['value'] = $value;
			$data['updated_at'] = Carbon::now();
			if (Setting::where('name', $key)->exists()) {
				Setting::where('name', '=', $key)->update($data);
			} else {
				$data['name'] = $key;
				$data['created_at'] = Carbon::now();
				Setting::insert($data);
			}
		}

		return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Social Link Updated')]);
	}




	public function profile(Request $request)
	{
		$user_id = auth()->user()->id;
		$model = Employee::where('user_id', $user_id)->first();
		return view('admin.setting.profile', compact('model'));
	}

	public function profile_update(Request $request)
	{
		$id = $request->id;
		$old_photo = '';
		$old_photo = $request->old_photo;

		$request->validate([
			'first_name' => ['required', 'max:255'],
			'last_name' => ['required', 'max:255'],
			'contact_number' => ['required', 'max:255'],
			'email' => ['required', 'email'],
			'photo' => 'mimes:jpeg,jpg,png | max:2000',

		]);

		$model = Employee::findOrFail($id);

		if ($request->hasFile('photo')) {
			if ($model->photo) {
				$image_path = public_path() . '/storage/logo/' . $model->photo;
				unlink($image_path);
			}
			$storagepath = $request->file('photo')->store('public/logo');
			$fileName = basename($storagepath);
			$model->photo = $fileName;
		} else {
			$model->photo = $old_photo;
		}

		$model->first_name = $request->first_name;
		$model->last_name = $request->last_name;
		$model->father_name = $request->father_name;
		$model->mother_name = $request->mother_name;
		$model->contact_number = $request->contact_number;
		$model->gender = $request->gender;
		$model->email = $request->email;
		$model->date_of_birth = $request->date_of_birth;

		$model->save();

		return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Profile  Updated.')]);
	}
}
