<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCampaign extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'campaign_id'          => [
					'type'           => 'VARCHAR',
					'constraint'     => "10",					
			],
			'tanggal_mulai'       => [
				'type'       => 'DATETIME',
				'null' => true,
			],
			'judul'       => [
					'type'       => 'TEXT',
					'null' => true,
			],
			'konten' => [
					'type' => 'TEXT',
					'null' => true,
			],
			'target' => [
				'type' => 'INTEGER',
				'null' => false,
			],
			'tanggal_selesai' => [
				'type' => 'DATETIME',
				'null' => true,
			],
		]);
		$this->forge->addKey('campaign_id', true);
		$this->forge->createTable('campaign');
	}

	public function down()
	{
		$this->forge->dropTable('campaign');
	}
}
