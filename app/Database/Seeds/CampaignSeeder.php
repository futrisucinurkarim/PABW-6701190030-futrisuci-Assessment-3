<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CampaignSeeder extends Seeder
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
	public function run()
	{
		$data = [
			'campaign_id' => "CP-".$this->randString(),
			'tanggal_mulai' => date("Y-m-d H:i:s"),
			'tanggal_selesai' => date("Y-m-d H:i:s"),
			'judul' => 'Lorem ipsum',
			'konten'    => 'Lorem ipsum dolor sit amet',
			'target'=> 100000,
		];
		$this->db->query("INSERT INTO campaign (campaign_id, judul,konten,tanggal_mulai,tanggal_selesai, target) VALUES(:campaign_id:, :judul:, :konten:,:tanggal_mulai:, :tanggal_selesai:,:target:)", $data);
	}
}
