<?php

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use App\Http\Requests\Insatll\InstallRequest;
use App\Repositories\Utilities\InstallRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InstallController extends Controller {
	protected $repo;
	protected $request;
	public function __construct(InstallRepository $repo, Request $request) {
		$this->repo = $repo;
		$this->request = $request;
		if (env('APP_INSTALLED', false) == true) {
			Redirect::to('/')->send();
		}
	}

	public function index() {
		return view('install.layout');
	}
	public function terms(InstallRequest $request) {
		return response()->json(['message' => 'Ok Buddy First Step Done Successfull. Let\'s Start Step 2.']);
	}
	public function server() {
		// $requirements = Installer::checkServerRequirements();
		$requirements = $this->repo->getPreRequisite();
		return view('install.step_1', compact('requirements'));
	}
	public function check_server() {
		$requirements = $this->repo->checkServer();
		return response()->json(['message' => 'It\'s Great. Let\'s Start Step 3.']);
	}
	public function database() {
		return view('install.step_2');
	}

	public function process_install(InstallRequest $request) {
		$this->repo->validateDatabase($request->all());
		return response()->json(['message' => 'Oh Nice. It\'s A Plasure. Let\'s Start Step 4.']);
	}

	public function create_user() {
		return view('install.step_3');
	}

	public function store_user(InstallRequest $request) {
		$this->repo->makeAdmin($request->all());
		return response()->json(['message' => 'One More Step And You Are Ready To Go.']);
	}

	public function system_settings() {
		return view('install.step_4');
	}

	public function final_touch(Request $request) {
		$this->repo->install($request->all());
		return response()->json(['message' => 'You Are Done. Just Click Login Button And Go, Explore The World.', 'goto' => route('login')]);
	}
}
