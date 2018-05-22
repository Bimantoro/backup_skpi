<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 *
 * @package		Revitalisasi SIA
 * @subpackage  skpi
 * @category    SKPI
 * @created 	Aug 07, 2017
 * @creator 	Danang Aji Bimantoro
*/


class Skpi_label extends CI_Controller
{
	protected $builtInMethods;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('skpi_basic/label_m', 'mdl_00');
	}


	function lihat($format = 'json')
	{
		$kode 			= (int)preg_replace("/[^0-9]/", "", $_POST['api_kode']);
		$subkode 		= (int)preg_replace("/[^0-9]/", "", $_POST['api_subkode']);
		$api_search 	= $this->input->post('api_search');
		switch($kode){
			case 1500: switch($subkode){ //untuk label master
				default:
					case 1: $query = $this->mdl_00->select_master_label($api_search[0]); break;
					case 2: $query = $this->mdl_00->select_master_label_aktif(); break;
					case 3: $query = $this->mdl_00->select_detail_label($api_search[0], '0'); break; //label posisi 0
					case 4: $query = $this->mdl_00->select_detail_label($api_search[0], '1'); break;//label posisi 1
					case 5: $query = $this->mdl_00->select_detail_label_ref($api_search[0]);  break;//label posisi 2 berdasarkan referensi id_ld
					case 6: $query = $this->mdl_00->select_detail_label_by_id($api_search[0]); break; //label posisi 2 berdasarkan referensi id_ld
					case 7: $query = $this->mdl_00->select_master_label_by_id($api_search[0]); break; //label posisi 2 berdasarkan referensi id_ld
					case 8: $query = $this->mdl_00->select_detail_label_by($api_search[0], $api_search[1], $api_search[2]); break; //label posisi x berdasarkan referensi id_l dan urutan
					case 9: $query = $this->mdl_00->cek_unused_label($api_search[0], $api_search[1]); break; //cek unused label
					case 10 : $query = $this->mdl_00->select_kode_penulisan(); break; //get seluruh kode penulisan
					case 11 : $query = $this->mdl_00->select_pengaturan_penulisan(); break; //get seluruh pengaturan penulisan sertifikasi
					case 12 : $query = $this->mdl_00->select_pengaturan_penulisan($api_search[0]); break; //get seluruh pengaturan penulisan sertifikasi by status
					case 13 : $query = $this->mdl_00->select_pengaturan_penulisan_by_kode($api_search[0], $api_search[1]); break; //get seluruh pengaturan penulisan sertifikasi by kode dan status
					case 14 : $query = $this->mdl_00->select_kode_penulisan_by_kode($api_search[0]); break; //get seluruh pengaturan penulisan sertifikasi by kode dan status
					case 15 : $query = $this->mdl_00->select_kode_penulisan_by_status($api_search[0]); break; //get seluruh pengaturan penulisan sertifikasi by status
					case 16 : $query = $this->mdl_00->select_pengaturan_penulisan_by_id($api_search[0]); break; //get seluruh pengaturan penulisan sertifikasi by id_ps
				break; 
			} 
		break;
		}
		
		$this->sia_api_lib_format->output($query, $format);
	}

	function simpan($format = 'json')
	{
		$kode 			= (int)preg_replace("/[^0-9]/", "", $_POST['api_kode']);
		$subkode 		= (int)preg_replace("/[^0-9]/", "", $_POST['api_subkode']);
		$api_search 	= $this->input->post('api_search');
		switch($kode){
			case 1500: switch($subkode){ //untuk label master
				default:
					case 1: $query = $this->mdl_00->insert_master_label($api_search[0]); break;
					case 2: $query = $this->mdl_00->insert_detail_label($api_search[0]); break;
					case 3: $query = $this->mdl_00->insert_unused_label($api_search[0], $api_search[1]); break;
					case 4: $query = $this->mdl_00->insert_kode_penulisan($api_search[0], $api_search[1], $api_search[2]); break;
					case 5: $query = $this->mdl_00->insert_pengaturan_penulisan($api_search[0], $api_search[1], $api_search[2], $api_search[3], $api_search[4], $api_search[5], $api_search[6]); break;
				break; 
			} 
		break;
		}

		$this->sia_api_lib_format->output($query, $format);
	}

	function update($format = 'json')
	{
		$kode 			= (int)preg_replace("/[^0-9]/", "", $_POST['api_kode']);
		$subkode 		= (int)preg_replace("/[^0-9]/", "", $_POST['api_subkode']);
		$api_search 	= $this->input->post('api_search');
		switch($kode){
			case 1500: switch($subkode){ //untuk label master
				default:
					case 1: $query = $this->mdl_00->update_detail_label($api_search[0], $api_search[1]); break;
					case 2: $query = $this->mdl_00->update_master_label_aktif($api_search[0], $api_search[1]); break;
					case 3: $query = $this->mdl_00->update_master_label($api_search[0], $api_search[1]); break;
					case 4: $query = $this->mdl_00->auto_update_status(); break;
					case 5: $query = $this->mdl_00->update_kode_penulisan($api_search[0], $api_search[1], $api_search[2], $api_search[3]); break;
					case 6: $query = $this->mdl_00->update_pengaturan_penulisan($api_search[0], $api_search[1], $api_search[2], $api_search[3], $api_search[4], $api_search[5], $api_search[6], $api_search[7]); break;
				break; 
			} 
		break;
		}

		$this->sia_api_lib_format->output($query, $format);
	}

	function hapus($format = 'json')
	{
		$kode 			= (int)preg_replace("/[^0-9]/", "", $_POST['api_kode']);
		$subkode 		= (int)preg_replace("/[^0-9]/", "", $_POST['api_subkode']);
		$api_search 	= $this->input->post('api_search');
		switch($kode){
			case 1500: switch($subkode){ //untuk label master
				default:
					case 1: $query = $this->mdl_00->delete_detail_label($api_search[0]); break;
					case 2: $query = $this->mdl_00->delete_unused_label($api_search[0], $api_search[1]); break;
					case 3: $query = $this->mdl_00->delete_kode_penulisan($api_search[0]); break;
				break; 
			} 
		break;
		}

		$this->sia_api_lib_format->output($query, $format);
	}
}	
