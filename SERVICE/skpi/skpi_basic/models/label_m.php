<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 *
 * @package     Revitalisasi SIA
 * @subpackage  skpi
 * @category    SKPI
 * @created     Aug 07, 2017
 * @creator     Danang Aji Bimantoro
*/

class Label_m extends CI_Model
{
    //table yang digunakan :
	private $tb_l  = 'tb_label';
	private $tb_ld = 'tb_label_detail';
    private $tb_ul = 'tb_unused_label';
    private $tb_kp = 'tb_kode_ps';
    private $tb_ps = 'tb_penulisan_sertifikasi';
    
    function __construct()
    {
        parent::__construct();
    }

    function cek_skpi($nim)
    {
        $q = $this->db->query("SELECT * FROM TB_TESTING WHERE NIM = '$nim' ");
        return $q->row_array();
    }

    function select_master_label($order)
    {
        $this->db->order_by($order, 'DESC');
        $q = $this->db->get($this->tb_l);
        return $q->result_array();
    }

    function select_master_label_aktif()
    {
        $q = $this->db->query("SELECT id_l FROM tb_label WHERE status='1';");
        return $q->row_array();
    }

    function select_master_label_by_id($id){
        $this->db->where('id_l', $id);
        $q = $this->db->get($this->tb_l);
        return $q->row_array();
    }

    function update_master_label_aktif($id, $data){
        //non aktifkan yang masih aktif
        $date = date('Y-m-d');
        $sql = "UPDATE tb_label SET status='0', tgl_selesai='".$date."' WHERE status='1';";
        $this->db->query($sql);

        //aktifasi label
        $this->db->query("UPDATE tb_label SET tgl_selesai=NULL WHERE id_l='$id';");
        $this->db->where('id_l', $id);
        $q = $this->db->update($this->tb_l, $data);
        return $q;
    }

    function update_master_label($id, $data){
        $this->db->where('id_l', $id);
        $q = $this->db->update($this->tb_l, $data);
        return $q;
    }

    function select_detail_label($id_l, $posisi)
    {
        $this->db->where('id_l', $id_l)->where('posisi', $posisi);
        $this->db->order_by('urut', 'ASC');
        $q = $this->db->get($this->tb_ld);
        return $q->result_array();
    }

    function select_detail_label_by($id_l, $posisi, $urut)
    {
        $this->db->where('id_l', $id_l)->where('posisi', $posisi)->where('urut', $urut);
        $q = $this->db->get($this->tb_ld);
        return $q->row_array();
    }

    function select_detail_label_ref($ref)
    {
        $this->db->where('ref', $ref);
        $this->db->order_by('urut', 'asc');
        $q = $this->db->get($this->tb_ld);
        return $q->result_array();
    }

    function select_detail_label_by_id($id)
    {
        $this->db->where('id_ld', $id);
        $q = $this->db->get($this->tb_ld);
        return $q->row_array();
    }

    function update_detail_label($id, $data)
    {
        $this->db->where('id_ld', $id);
        $q = $this->db->update($this->tb_ld, $data);
        return $q;
        
    }

    function insert_master_label($data){
        $this->db->insert($this->tb_l, $data);
        $q = $this->db->query("SELECT id_l FROM tb_label ORDER BY id_l DESC LIMIT 1;");
        return $q->row_array();
    }

    function insert_detail_label($data){
        $q = $this->db->insert($this->tb_ld, $data);
        return $q;
    }

    function delete_detail_label($id){
        $this->db->where('id_ld', $id);
        $q = $this->db->delete($this->tb_ld);
        return $q;
    }

    function cek_unused_label($kd_prodi, $id_ld){
        $this->db->where('kd_prodi', $kd_prodi)->where('id_ld', $id_ld);
        $q = $this->db->get($this->tb_ul);
        return $q->row_array();
    }

    function insert_unused_label($kd_prodi, $id_ld){
        $data = array('kd_prodi' => $kd_prodi, 'id_ld' => $id_ld);
        $q = $this->db->insert($this->tb_ul, $data);
        return $q;
    }

    function delete_unused_label($kd_prodi, $id_ld){
        $this->db->where('kd_prodi', $kd_prodi)->where('id_ld', $id_ld);
        $q = $this->db->delete($this->tb_ul);
        return $q;
    }

    function select_kode_penulisan(){
        $q = $this->db->get($this->tb_kp);
        $q = $q->result_array();
        return $q;
    }

    function select_kode_penulisan_by_status($status){
        $this->db->where('status', $status);
        $q = $this->db->get($this->tb_kp)->result_array();
        return $q;
    }

    function select_kode_penulisan_by_kode($kode){
        $this->db->where('kode', $kode);
        $q = $this->db->get($this->tb_kp)->row_array();
        return $q;
    }

    function select_pengaturan_penulisan($status = 'X0X'){
        if($status == 'X0X'){
            $this->db->order_by('status', 'DESC'); //order_by('urutan', 'ASC')->
            $this->db->order_by('urutan', 'ASC'); //order_by('urutan', 'ASC')->
            $q = $this->db->get($this->tb_ps);
            $q = $q->result_array();
        }else{
            $this->db->where('status', $status);
            $this->db->order_by('urutan', 'ASC');
            $q = $this->db->get($this->tb_ps);
            $q = $q->result_array();
        }
        return $q;
    }

    function select_pengaturan_penulisan_by_kode($kode, $status){
        $this->db->where('kode', $kode)->where('status', $status);
        $q = $this->db->get($this->tb_ps);
        return $q->row_array();
    }

    function select_pengaturan_penulisan_by_id($id_ps){
        $this->db->where('id_ps', $id_ps);
        $q = $this->db->get($this->tb_ps);
        return $q->row_array();
    }

    function insert_kode_penulisan($kode, $keterangan, $status){
        $data = array ('kode' => $kode, 'keterangan' => $keterangan, 'status' => $status);
        $q    = $this->db->insert($this->tb_kp, $data);
        return $q;
    }

    function delete_kode_penulisan($kode){
        $this->db->where('kode', $kode);
        $q = $this->db->delete($this->tb_kp);
        return $q;
    }

    function update_kode_penulisan($old_kode, $kode, $keterangan, $status){
        $data = array ('kode' => $kode, 'keterangan' => $keterangan, 'status' => $status);
        $this->db->where('kode', $old_kode);
        $q = $this->db->update($this->tb_kp, $data);
        return $q;
    }

    function insert_pengaturan_penulisan($kode, $nama_idn, $nama_en, $unit_idn, $unit_en, $urutan, $status){

        if($status == 1){
            $old = $this->select_pengaturan_penulisan_by_kode($kode, '1');
            if($old){
                $oldData = array('status' => '0');
                $this->db->where('id_ps', $old['id_ps']);
                $this->db->update($this->tb_ps, $oldData);                                
            }
        }

        $data = array(
            'kode' => $kode,
            'nama_idn' => $nama_idn,
            'nama_en' => $nama_en,
            'unit_idn' => $unit_idn,
            'unit_en' => $unit_en,
            'urutan' => $urutan,
            'status' => $status
        );

        $q = $this->db->insert($this->tb_ps, $data);
        return $q;

    }

    function update_pengaturan_penulisan($id, $kode, $nama_idn, $nama_en, $unit_idn, $unit_en, $urutan, $status){

        if($status == 1){
            $old = $this->select_pengaturan_penulisan_by_kode($kode, '1');
            if($old){
                if($old['id_ps'] != $id){
                    $oldData = array('status' => '0');
                    $this->db->where('id_ps', $old['id_ps']);
                    $this->db->update($this->tb_ps, $oldData);
                }                
            }
        }

        $data = array(
            'kode' => $kode,
            'nama_idn' => $nama_idn,
            'nama_en' => $nama_en,
            'unit_idn' => $unit_idn,
            'unit_en' => $unit_en,
            'urutan' => $urutan,
            'status' => $status
        );

        $this->db->where('id_ps', $id);
        $q = $this->db->update($this->tb_ps, $data);
        return $q;
    }

}