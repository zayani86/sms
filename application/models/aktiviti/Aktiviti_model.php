<?php

class Aktiviti_model extends CI_Model
{

    public function get_dt_activity_list()
    {
        $this->db->select("a.*, kategori_sesi.keterangan ");
        $this->db->from('aktiviti a');
        $this->db->join('konf_kod kategori_sesi', 'kategori_sesi.id = a.kategori_sesi');

        $this->db->where('a.is_active', 1);
        $this->db->where('a.soft_delete', 0);
        $this->db->order_by('a.tarikh_mula', 'desc');
        $query = $this->db->get();

        return $query->result_object();
    }

    public function get_activity($activity_id)
    {

        $this->db->select('a.*, kategori_sesi.keterangan, jenis_sesi.keterangan as js_desc, sasaran.keterangan as s_desc, pendekatan.keterangan as p_desc, perkhidmatan.keterangan as perkhid_desc, fokus.keterangan as fokus_desc, fokus_sub.keterangan as sub_fokus_desc, klasifikasi.keterangan as klasifikasi_desc, kelas.kelas as kelas_desc, kategori_k.keterangan as kategori_k_desc, program_j.keterangan as program_j_desc, kategori_cakna.keterangan as kat_cakna_desc, kategori_impak.keterangan as impak_cakna_desc');
        $this->db->from('aktiviti a ');
        $this->db->join('konf_kod kategori_sesi', 'kategori_sesi.id = a.kategori_sesi');
        $this->db->join('konf_kod jenis_sesi', 'jenis_sesi.id = a.jenis_sesi', 'left');
        $this->db->join('konf_kod sasaran', 'sasaran.id = a.sasaran_id', 'left');
        $this->db->join('konf_kod pendekatan', 'pendekatan.id = a.pendekatan_id', 'left');
        $this->db->join('konf_kod perkhidmatan', 'perkhidmatan.id = a.jenis_perkhidmatan_id', 'left');
        $this->db->join('konf_kod fokus', 'fokus.id = a.fokus_id', 'left');
        $this->db->join('konf_kod fokus_sub', 'fokus_sub.id = a.fokus_sub_id', 'left');
        $this->db->join('konf_kod klasifikasi', 'klasifikasi.id = a.klasifikasi_kg_id', 'left');
        $this->db->join('tbl_kelas kelas', 'kelas.id = a.kelas', 'left');
        $this->db->join('konf_kod kategori_k', 'kategori_k.id = a.kategori_klien', 'left');
        $this->db->join('konf_kod program_j', 'program_j.id = a.jenis_program_id', 'left');
        $this->db->join('konf_kod kategori_cakna', 'kategori_cakna.id = a.kategori_cakna', 'left');
        $this->db->join('konf_kod kategori_impak', 'kategori_impak.id = a.impak_cakna', 'left');
        $this->db->where('a.id', $activity_id);

        $query = $this->db->get();
        return $query->row_object();
    }

    public function get_activity_details($activity_id)
    {
        $this->db->select("ad.*");
        $this->db->from('aktiviti_details ad');
        $this->db->where('ad.aktiviti_id', $activity_id);

        $query = $this->db->get();

        return $query->row_object();

    }
}
