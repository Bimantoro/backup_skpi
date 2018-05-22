<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 *
 * @package		Revitalisasi SIA
 * @subpackage  skpi
 * @category    SKPI
 * @created 	Aug 01, 2017
 * @creator 	
*/

class Skpi_basic extends CI_Controller
{
	protected $builtInMethods;
 
	public function __construct() {
		parent::__construct();
		$this->load->model('skpi_basic/mdl_basic', 'mdl_00');
	}
	#untuk fungsi-fungsi dasar
	function index() 
	{
		echo "skpi basic";	
	}
	
	function cek($format = 'json')
	{
		$kode 			= (int)preg_replace("/[^0-9]/", "", $_POST['api_kode']);
		$subkode 		= (int)preg_replace("/[^0-9]/", "", $_POST['api_subkode']);
		$api_search 	= $this->input->post('api_search');
		switch($kode){
			case 1500: switch($subkode){
				default:
					case 1: $query = $this->mdl_00->cek_skpi($api_search[0]); break;
					case 2: $query = $this->mdl_00->cek_skpi_by_sts($api_search[0]); break;
					case 3: $query = $this->mdl_00->cek_skpi(); break;
					case 4: $query = $this->mdl_00->cek_cp($api_search[0]); break;
					case 5: $query = $this->mdl_00->cek_kegiatan($api_search[0],'PRESTASI'); break; //KHUSUS KEGIATAN PRESTASI
					case 6: $query = $this->mdl_00->cek_kegiatan($api_search[0],'ORGANISASI'); break; //KHUSUS KEGIATAN ORGANISASI
					case 7: $query = $this->mdl_00->cek_kegiatan($api_search[0],'SERTIFIKASI'); break; //KHUSUS KEGIATAN SERTIFIKASI
					case 8: $query = $this->mdl_00->cek_kegiatan($api_search[0],'MAGANG'); break; //KHUSUS KEGIATAN MAGANG
					case 9: $query = $this->mdl_00->cek_kegiatan($api_search[0],'KARAKTER'); break; //KHUSUS KEGIATAN KARAKTER
					case 10: $query = $this->mdl_00->cek_status_kegiatan($api_search[0]); break; //CEK ID RIWAYAT APAKAH ADA ATAU TIDAK (0 :: 1)
					case 11: $query = $this->mdl_00->no_seri(); break; //
					case 12: $query = $this->mdl_00->cek_status_skpi($api_search[0]); break; 								
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
			case 1500: switch($subkode){
				default:
					case 1: $query = $this->mdl_00->insert_skpi($api_search[0]); break;
					case 2: $query = $this->mdl_00->insert_cp($api_search[0]); break;
					case 3: $query = $this->mdl_00->insert_kegiatan($api_search[0]); break;
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
			case 1500: switch($subkode){
				default:
					case 1: $query = $this->mdl_00->update_skpi($api_search[0], $api_search[1]); break;
					case 2: $query = $this->mdl_00->update_kegiatan($api_search[0], $api_search[1]); break; //kayaknya bakalan ada berubahan :: (nim, kd_prestasi, data) menggunakan 3 parameter
					case 3: $query = $this->mdl_00->update_noseri($api_search[0], $api_search[1]); break; //untuk mengupdate nomer seri setiap di cetak
					case 4: $query = $this->mdl_00->update_keterangan($api_search[0], $api_search[1]); break; //untuk update ketererangan pasca dilakukan pembatalan verifikasi
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
			case 1500: switch($subkode){
				default:
					case 1: $query = $this->mdl_00->delete_skpi($api_search[0]); break;
					case 2: $query = $this->mdl_00->delete_cp_by_nim($api_search[0]); break;
					case 3: $query = $this->mdl_00->delete_cp_by_kd_cp($api_search[0], $api_search[1]); break;
					case 4: $query = $this->mdl_00->delete_kegiatan_by_nim($api_search[0], 'PRESTASI'); break;     
					case 5: $query = $this->mdl_00->delete_kegiatan_by_kd_k($api_search[0], $api_search[1], 'PRESTASI'); break;   
					case 6: $query = $this->mdl_00->delete_kegiatan_by_nim($api_search[0], 'ORGANISASI'); break;      
					case 7: $query = $this->mdl_00->delete_kegiatan_by_kd_k($api_search[0], $api_search[1], 'ORGANISASI'); break;   
					case 8: $query = $this->mdl_00->delete_kegiatan_by_nim($api_search[0], 'SERTIFIKASI'); break;    
					case 9: $query = $this->mdl_00->delete_kegiatan_by_kd_k($api_search[0], $api_search[1], 'SERTIFIKASI'); break;   
					case 10: $query = $this->mdl_00->delete_kegiatan_by_nim($api_search[0], 'MAGANG'); break;     
					case 11: $query = $this->mdl_00->delete_kegiatan_by_kd_k($api_search[0], $api_search[1], 'MAGANG'); break;   
					case 12: $query = $this->mdl_00->delete_kegiatan_by_nim($api_search[0], 'KARAKTER'); break;      
					case 13: $query = $this->mdl_00->delete_kegiatan_by_kd_k($api_search[0], $api_search[1], 'KARAKTER'); break;   
					case 14: $query = $this->mdl_00->delete_skpi_by_nim($api_search[0]); break;
			} 
		break;
		}
		$this->sia_api_lib_format->output($query, $format);
	}

	function get_tanggal_daftar($format = 'json'){
		$api_search = $this->input->post('api_search');		
		$query 		= $this->mdl_00->get_tanggal_daftar($api_search[0]);
		$this->sia_api_lib_format->output($query, $format);
	}

	function get_all_tanggal_daftar($format = 'json'){
		$api_search = $this->input->post('api_search');		
		$query 		= $this->mdl_00->get_tanggal_daftar();
		$this->sia_api_lib_format->output($query, $format);
	}

	function get_data_pendaftar($format = 'json'){
		$api_search = $this->input->post('api_search');		
		$query 		= $this->mdl_00->get_data_verifikasi($api_search[0], $api_search[1], $api_search[2]);
		$this->sia_api_lib_format->output($query, $format);
	}

	function get_all_data_pendaftar($format = 'json'){
		$api_search = $this->input->post('api_search');		
		$query 		= $this->mdl_00->get_data_verifikasi($api_search[0], $api_search[1]);
		$this->sia_api_lib_format->output($query, $format);
	}

	//testing
}	