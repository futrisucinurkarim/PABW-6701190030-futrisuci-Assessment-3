<?php

namespace App\Controllers;
use App\Models\CampaignModel;
use Config\Services;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
	public function randString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	public function index()
	{
		return view('list');
	}
	public function get()
    {
        $request = Services::request();
        $datatable = new CampaignModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $list->campaign_id;
                $row[] = $list->tanggal_mulai;
				$row[] = $list->tanggal_selesai;
                $row[] = $list->judul;
				$row[] = $list->konten;
				$row[] = $list->target;
				$row[] = '<a class="btn btn-sm btn-primary" href="'.$list->campaign_id.'/edit">Edit</a>&nbsp;<a href="#" data-href="'.base_url('/'.$list->campaign_id.'/delete').'" onclick="confirmToDelete(this)" class="btn btn-sm btn-danger">Hapus</a>';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
	public function tambah() {
		return view('tambah');
	}
	public function add() {
		// lakukan validasi
		$request = Services::request();
        $validation =  Services::validation();
        $validation->setRules(
			[
				'judul' => 'required', 
				'tanggal_mulai'=>'required',
				'tanggal_selesai'=>'required',
				'target'=>'required',
			]
		);
        $isDataValid = $validation->withRequest($request)->run();

        // jika data valid, simpan ke database
        if($isDataValid){
            $model = new CampaignModel($request);
            $model->insert([
				"campaign_id" => "CP-".$this->randString(),
				"tanggal_mulai" => $request->getPost('tanggal_mulai'),
				"tanggal_selesai" => $request->getPost('tanggal_selesai'),
                "judul" => $request->getPost('judul'),
                "konten" => $request->getPost('konten'),
				"target" => $request->getPost('target'),
            ]);
            return redirect('/');
        }
		
        // tampilkan form create
        echo view('tambah');
	}
	public function edit($id) {
		$request = Services::request();
		$model = new CampaignModel($request);
		$data['data'] = $model->where('campaign_id', $id)->first();
		
		if(!$data['data']){
			throw PageNotFoundException::forPageNotFound();
		}
		echo view('edit', $data);
	}
	public function update($id) {
		$request = Services::request();
		// ambil campaign yang akan diedit
        $model = new CampaignModel($request);
        $data['data'] = $model->where('campaign_id', $id)->first();
        
        // lakukan validasi data campaign
        $validation =  Services::validation();
        $validation->setRules([
            'campaign_id' => 'required',
            'judul' => 'required', 
			'tanggal_mulai'=>'required',
			'tanggal_selesai'=>'required',
			'target'=>'required',
        ]);
        $isDataValid = $validation->withRequest($request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $model->update($id, [
                "tanggal_mulai" => $request->getPost('tanggal_mulai'),
				"tanggal_selesai" => $request->getPost('tanggal_selesai'),
                "judul" => $request->getPost('judul'),
                "konten" => $request->getPost('konten'),
				"target" => $request->getPost('target'),
            ]);
            return redirect('/');
        }

        // tampilkan form edit
        echo view('edit', $data);
    }

    //--------------------------------------------------------------------------

	public function delete($id){
		$request = Services::request();
        $model = new CampaignModel($request);
        $model->delete($id);
        return redirect('/');
    }
}
