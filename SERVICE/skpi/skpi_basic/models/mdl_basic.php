<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 *
 * @package		Revitalisasi SIA
 * @subpackage  skpi
 * @category    Model Basic for skpi
 * @creator     
 * @created     Aug 01 2017
*/
 
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
class Mdl_basic extends CI_Model
{
	private $tb_skpi = 'tb_skpi'; private $tb_cp = 'tb_cp'; private $tb_prestasi = 'tb_prestasi'; private $tb_kegiatan = 'tb_kegiatan';

    function __construct() {
        parent::__construct();
    }

    function cek_status_skpi($nim)
    {

        $this->db->where('nim', $nim);
        $q = $this->db->get($this->tb_skpi);
        $q = $q->row_array();
        if($q){
             if($q['status']=='0'){
                 $temp = array (
                     'NIM'        => $q['nim'],
                     'NO_SERI'    => $q['no_skpi'],
                     'STATUS'     => 'SUDAH DAFTAR',
                     'KETERANGAN' => 'BELUM DI VERIFIKASI'
                 );
             }else{
                 $temp = array (
                     'NIM'        => $q['nim'],
                     'NO_SERI'    => $q['no_skpi'],
                     'STATUS'     => 'SUDAH DAFTAR',
                     'KETERANGAN' => 'SUDAH DI VERIFIKASI'
                 );
             }

        }else{
            $temp = array (
                'NIM'        => $nim,
                'NO_SERI'    => '-',
                'STATUS'     => 'BELUM DAFTAR VERIFIKASI',
                'KETERANGAN' => ''
            );
         }

        //$tt = array ('test' => 'test');

        return $temp;
    }

    function cek_status_kegiatan($kd_kegiatan)
    {
    	$this->db->select('kd_kegiatan, saran, status');
    	$this->db->from($this->tb_kegiatan);
    	$this->db->where('kd_kegiatan', $kd_kegiatan);
    	$q = $this->db->get()->row_array();
    	if($q){
            $temp['STATUS'] = 'SUDAH';
            if($q['status']=='0'){
                $temp['PENULISAN'] = 'BELUM';
            }else{
                $temp['PENULISAN'] = 'SUDAH';
            }            
    		$temp['SARAN'] = $q['saran'];
    	}else{
            $temp['STATUS'] = 'BELUM';
            $temp['PENULISAN'] = '-';
    		$temp['SARAN'] = '-';
    	}

    	return $temp;
    }

    function no_seri()
    {
        $q = $this->db->query("select nextval('seri_seq') as AI")->result();
        return $q;
    }

    function update_noseri($nim, $noseri)
    {
        $data = array('no_skpi' => $noseri);
        $this->db->where('nim', $nim);
        $q = $this->db->update($this->tb_skpi, $data);
        return $q;
    }

    function update_keterangan($nim, $keterangan)
    {
        $data = array('keterangan' => $keterangan);
        $this->db->where('nim', $nim);
        $q = $this->db->update($this->tb_skpi, $data);
        return $q;
    }

    function cek_skpi($nim = '')
    {	
    	if($nim==''){
    		$q = $this->db->get($this->tb_skpi);
	        return $q->result_array();
    	}else{
    		$this->db->where('nim', $nim);
	    	$q = $this->db->get($this->tb_skpi);
	        return $q->row_array();
    	}
    }

    function cek_skpi_by_sts($status)
    {
    	$this->db->where('status', $status);
    	$q = $this->db->get($this->tb_skpi);
    	return $q->result_array();
    }

    function cek_cp($nim)
    {
    	$this->db->where('nim', $nim);
    	$q = $this->db->get($this->tb_cp);
        return $q->result_array();
    }

    // function cek_prestasi($nim)
    // {
    // 	$this->db->where('nim', $nim);
    // 	$q = $this->db->get($this->tb_prestasi);
    //     return $q->result_array();
    // }

    function cek_kegiatan($nim, $jenis)
    {
    	$this->db->where('nim', $nim)->where('jenis', $jenis);
    	$q = $this->db->get($this->tb_kegiatan);
        return $q->result_array();
    }

    function insert_skpi($data)
    {
    	$q = $this->db->insert($this->tb_skpi, $data);
    	return $q;
    }

    function insert_cp($data)
    {
    	$q = $this->db->insert($this->tb_cp, $data);
    	return $q;
    }

    // function insert_prestasi($data)
    // {
    // 	$q = $this->db->insert($this->tb_prestasi, $data);
    // 	return $q;
    // }

    // function insert_organisasi($data)
    // {
    // 	$q = $this->db->insert($this->tb_prestasi, $data);
    // 	return $q;
    // }

    function insert_kegiatan($data)
    {
    	$q = $this->db->insert($this->tb_kegiatan, $data);
    	return $q;
    }

    function update_skpi($nim, $status)
    {
    	$this->db->where('nim', $nim);
   		$q = $this->db->update($this->tb_skpi, $status);
   		return $q;
    }

    // function update_prestasi($id_p, $data)
    // {
    // 	$this->db->where('id_p', $id_p);
    // 	$q = $this->db->update($this->tb_prestasi, $data);
    // 	return $q;
    // }

    function update_kegiatan($kd_kegiatan, $data)
    {
    	$this->db->where('kd_kegiatan', $kd_kegiatan);
    	$q = $this->db->update($this->tb_kegiatan, $data);
    	return $q;
    }

    function delete_skpi($id_s)
    {
    	$this->db->where('id_s', $id_s);
    	$q = $this->db->delete($this->tb_skpi);
    	return $q;
    }

    function delete_skpi_by_nim($nim)
    {
        $this->db->where('nim', $nim);
        $q = $this->db->delete($this->tb_skpi);
        return $q;
    }

    function delete_cp_by_nim($nim)
    {
    	$this->db->where('nim', $nim);
    	$q = $this->db->delete($this->tb_cp);
    	return $q;
    }

    function delete_cp_by_kd_cp($nim, $kd_cp)
    {
    	$this->db->where('nim', $nim)->where('kd_cp', $kd_cp);
    	$q = $this->db->delete($this->tb_cp);
    	return $q;
    }



  //   function delete_prestasi_by_nim($nim)
  //   {
		// $this->db->where('nim', $nim)->where('jenis', 'PRESTASI');
  //   	$q = $this->db->delete($this->tb_prestasi);
  //   	return $q;
  //   }

  //   function delete_prestasi_by_kd_p($nim, $kd_k)
  //   {
  //   	$this->db->where('nim', $nim)->where('kd_kegiatan', $kd_k)->where('jenis', 'PRESTASI');
  //   	$q = $this->db->delete($this->tb_prestasi);
  //   	return $q;
  //   }



    function delete_kegiatan_by_nim($nim, $jenis)
    {
		$this->db->where('nim', $nim)->where('jenis', $jenis);
    	$q = $this->db->delete($this->tb_kegiatan);
    	return $q;
    }

    function delete_kegiatan_by_kd_k($nim, $kd_k, $jenis)
    {
    	$this->db->where('nim', $nim)->where('kd_kegiatan', $kd_k)->where('jenis', $jenis);
    	$q = $this->db->delete($this->tb_kegiatan);
    	return $q;
    }

    function get_tanggal_daftar($kd_prodi = 'X0X'){
        if($kd_prodi == 'X0X'){
            $sql = "SELECT EXTRACT(YEAR FROM tgl_daftar) as tahun, EXTRACT(MONTH FROM tgl_daftar) as bulan FROM ".$this->tb_skpi." GROUP BY 1, 2 ORDER BY 1 DESC";
            // $sql = "SELECT * FROM tb_skpi";
         }else{
            $sql = "SELECT EXTRACT(YEAR FROM tgl_daftar) as tahun, EXTRACT(MONTH FROM tgl_daftar) as bulan FROM ".$this->tb_skpi." WHERE kd_prodi = '$kd_prodi' GROUP BY 1, 2 ORDER BY 1 DESC";
        }

        $q = $this->db->query($sql);
        return $q->result_array();

       // return 'hallo';
    }

    function get_data_verifikasi($tahun, $bulan, $kd_prodi = 'X0X'){
       if($kd_prodi == 'X0X'){
            if($bulan == 'ALL'){
               $sql = "SELECT * FROM ".$this->tb_skpi." WHERE EXTRACT(YEAR FROM tgl_daftar) = '$tahun' ORDER BY tgl_daftar DESC";
            }else{
               $sql = "SELECT * FROM ".$this->tb_skpi." WHERE EXTRACT(YEAR FROM tgl_daftar) = '$tahun' AND EXTRACT(MONTH FROM tgl_daftar) = '$bulan' ORDER BY tgl_daftar DESC";
            }
       }else{
            if($bulan == 'ALL'){
                $sql = "SELECT * FROM ".$this->tb_skpi." WHERE EXTRACT(YEAR FROM tgl_daftar) = '$tahun' AND kd_prodi = '$kd_prodi' ORDER BY tgl_daftar DESC";
            }else{
                $sql = "SELECT * FROM ".$this->tb_skpi." WHERE EXTRACT(YEAR FROM tgl_daftar) = '$tahun' AND EXTRACT(MONTH FROM tgl_daftar) = '$bulan' AND kd_prodi = '$kd_prodi' ORDER BY tgl_daftar DESC";
            }
       }

       $q = $this->db->query($sql);
       return $q->result_array();
       
    }

}