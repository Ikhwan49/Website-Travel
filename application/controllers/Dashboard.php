<?php

class Dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('role_id') != '2'){
            $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Anda belum login!!
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>');
            redirect('auth/login');
        }
    }

    public function tambah_ke_keranjang($id)
    {
        $barang = $this->model_barang->find($id);
        $data = array(
            'id'      => $barang->id_brg,
            'qty'     => 1,
            'price'   => $barang->harga,
            'name'    => $barang->nama_brg
    );
    
    $this->cart->insert($data);
    redirect('welcome');
    }  

    public function detail_keranjang()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('keranjang');
        $this->load->view('templates/footer');
    }

    public function hapus_keranjang()
    {
        $this->cart->destroy();
        redirect('welcome');
    }

    public function pembayaran()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembayaran');
        $this->load->view('templates/footer');
    }

    public function proses_pesanan()
    {
        if($this->input->post('cetakpsn')) {
            $id = $this->input->post('cetakpsn');
        $query = $this->db->query("SELECT id_invoice FROM tb_pesanan WHERE id=$id");
        $row = $query->row();
        $idinvoic = $row->id_invoice;
        
$query = $this->db->query("SELECT tb_pesanan.nama_brg,tb_pesanan.jumlah,tb_pesanan.harga,tb_invoice.nama,tb_invoice.alamat,tb_invoice.tgl_bayar
FROM tb_pesanan
INNER JOIN tb_invoice ON tb_pesanan.id_invoice =tb_invoice.id AND tb_pesanan.id_invoice=$idinvoic");
 $data['ctk'] = $query->result();


// panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $data['title_pdf'] = 'Laporan Pembelian';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_pembelian';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
        $html =$this->load->view('laporan_pdf', $data, TRUE);    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        }else{
$is_processed = $this->model_invoice->index();
        if($is_processed && $is_processed !=0){
            $data['pesanan'] = $is_processed;
        $this->cart->destroy();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('proses_pesanan', $data);
        $this->load->view('templates/footer');
        } else {
            echo "Maaf, Pesanan Anda Gagal diproses";
        }
        }
        
    }

    public function detail($id_brg)
    {
        $data['barang'] = $this->model_barang->detail_brg($id_brg);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('detail_barang', $data);
        $this->load->view('templates/footer');
    }

}